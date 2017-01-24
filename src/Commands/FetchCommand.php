<?php

namespace Mogria\Composer2nix\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

use Composer\IO\ConsoleIO;
use Composer\Config;
use Composer\Repository\RepositoryFactory;
use Composer\Repository\CompositeRepository;

class FetchCommand extends Command {
    protected function configure() {
        $this->setName('fetch-composer')
             ->addArgument('name', InputArgument::REQUIRED, 'The name of the package in the format of <vendor>/<packagename>')
             ->addArgument('target', InputArgument::OPTIONAL, 'Target version range as specified in composer.json')
             ->addArgument('version', InputArgument::OPTIONAL, 'Exact package version as specified in composer.lock')
	     ->addOption('out', null, InputOption::VALUE_REQUIRED, 'The output directory to fetch dependency to', './vendor')
             ->setDescription('Fetch a single composer dependency');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $packageName = $input->getArgument('name');

        $config = new Config(/* useEnvironment = */ false);
        $config->merge([
            'config' => [
                // FIXME: work without a cache in the moment, this throws out some PHP-Notices and composer warns about it, but it works.
                'home' => '/dev/null', 
                // I don't think we need the source distribution at all, so let's stick to dist
                'preferred-install' => 'dist' 
            ]
        ]);

        $io = new ConsoleIO($input, $output, $this->getHelperSet());

        $repositories = RepositoryFactory::defaultRepos($io, $config);
        $rootRepository = new CompositeRepository($repositories);

        // TODO: dynamically create constraint out of the target and
        // version arguments, at the moment just pull the lattest stuff
        $matchedPackage = $rootRepository->findPackage(
            $packageNamematchedPackage->getName(),
            new \Composer\Semver\Constraint\EmptyConstraint()
        );
        if($matchedPackage === NULL) {
            // no package found
            return 2;
        }

        $downloader = (new \Composer\Factory())->createDownloadManager($io, $config);
        // FIXME: Maybe find a better scheme to set the path to download too,
        // and take a look at the actual composer sources for this. This might be important for
        // some autoloader stuff.
        $downloader->download($matchedPackage, $input->getOption('out') . DIRECTORY_SEPARATOR . $matchedPackage->getName());
    }
}
