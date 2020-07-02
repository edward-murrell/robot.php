<?php
declare(strict_types=1);

namespace Robot\Tests\Functional;

use Robot\Tests\TestCases\CliTestCase;

/**
 * Functional test of the cli bin/robot.php command.
 */
class CliTest extends CliTestCase
{
    public function testInputCapture(): void
    {
        $inputFile = 'tests/Scenarios/exampleA.txt';
        $expected = ['0,1,NORTH'];
        $binary = 'php ' . dirname(__DIR__, 2) . '/bin/robot.php';

        $actual = [];
        exec("{$binary} {$inputFile}", $actual);

        $this->assertEquals($expected, $actual);
    }
}