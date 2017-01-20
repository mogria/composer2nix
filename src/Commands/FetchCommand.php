<?php

namespace Mogria\Composer2nix\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

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
    }
}
