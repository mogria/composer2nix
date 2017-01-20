<?php

namespace Mogria\Composer2Nix\Tests\Cli;
use Mogria\Composer2Nix\ExpressionGenerator;

class FetcherTest extends \PHPUnit_Framework_TestCase {

    protected function makeProcess($command, &$output) {
        $pipes = [];	
	$process = proc_open(__DIR__ . '/../../bin/' . $command,
            [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']], $pipes);
	$output = stream_get_contents($pipes[1]);
	fclose($pipes[0]);
	fclose($pipes[1]);
	fclose($pipes[2]);
	return proc_close($process);
    }

    public function test_composer2nix_noPackageName() {
        $output = "";
	$exitCode = $this->makeProcess('fetch-composer', $output);
	$this->assertEquals(1, $exitCode, "fetch-composer should fail when no package name is provided");
    }
    public function test_composer2nix_help() {
        $output = "";
	$exitCode = $this->makeProcess('fetch-composer --help', $output);
	$this->assertEquals(0, $exitCode, "fetch-composer should exit with 0 when --help is given");
	$this->assertContains("Usage:", $output);
	$this->assertContains("Arguments:", $output);
	$this->assertContains("Options:", $output);
    }

}
