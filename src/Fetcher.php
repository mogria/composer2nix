<?php
namespace Mogria\Composer2Nix;
use Mogria\Composer2Nix\Commands\FetchCommand;
use Symfony\Component\Console\Application;

class Fetcher {
    protected $application;

    public function __construct() {
        $this->application = new Application();
	$fetchCommand = new FetchCommand();
	$this->application->add($fetchCommand);
	$this->application->setDefaultCommand($fetchCommand->getName(), true);
    }

    public function fetch() {
	$this->application->run();
    }
}
