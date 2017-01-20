<?php

namespace Mogria\Composer2Nix\Tests\Cli;
use Mogria\Composer2Nix\ExpressionGenerator;

class ExpressionGeneratorTest extends \PHPUnit_Framework_TestCase {
    public function test_composer2nix_runs() {
        $output = [];	
	$exitCode = -1;
        exec(__DIR__ . '/../../bin/composer2nix', $output, $exitCode);
	$this->assertEquals(0, $exitCode, "composer2nix failed to run with no arguments");
    }
}
