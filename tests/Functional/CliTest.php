<?php
declare(strict_types=1);

namespace Robot\Tests\Functional;

use Robot\Tests\TestCases\CliTestCase;

/**
 * Functional test of the cli bin/robot.php command.
 */
class CliTest extends CliTestCase
{
    /**
     * Get list of successful scenarios.
     *
     * @return iterable<array<string|array<string>>> Filepath to input, and list of expected output.
     */
    public function getSuccessfulScenarios(): iterable
    {
        yield 'Example A, single response, provided in PROBLEM.md.' => [
            'examples/exampleA.txt',
            ['0,1,NORTH']
        ];

        yield 'Example B, single response, provided in PROBLEM.md.' => [
            'examples/exampleB.txt',
            ['0,0,WEST']
        ];

        yield 'Example C, single response, provided in PROBLEM.md.' => [
            'examples/exampleC.txt',
            ['3,3,NORTH']
        ];
    }

    /**
     * Test input and output of simple scenarios.
     *
     * @dataProvider getSuccessfulScenarios
     *
     * @param string $inputFile Path to input file, from root.
     * @param array<string> $expected List of expected strings.
     */
    public function testInputCapture(string $inputFile, array $expected): void
    {
        $binary = realpath(dirname(__DIR__, 2) . '/bin/robot.php');
        $inputFile = realpath(dirname(__DIR__, 2) . '/' . $inputFile);
        $command = "php {$binary} {$inputFile}";

        $actual = [];
        exec($command, $actual);

        $this->assertEquals($expected, $actual);
    }
}