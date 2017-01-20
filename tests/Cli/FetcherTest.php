<?php

namespace Mogria\Composer2Nix\Tests\Cli;
use Mogria\Composer2Nix\ExpressionGenerator;

class FetcherTest extends \PHPUnit_Framework_TestCase {
    public function test_composer2nix_runs() {
        $output = [];	
	$exitCode = -1;
        exec(__DIR__ . '/../../bin/fetch-composer', $output, $exitCode);
	$this->assertEquals(0, $exitCode, "fetch-composer failed to run with no arguments");
    }
}
