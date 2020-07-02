<?php
declare(strict_types=1);

namespace Robot\Tests\Interpreter;

use Robot\Enum\Direction;
use Robot\Instruct\Left;
use Robot\Instruct\Move;
use Robot\Instruct\Place;
use Robot\Instruct\Report;
use Robot\Instruct\Right;
use Robot\Interpreter\FileInterpreter;
use Robot\Tests\TestCases\SimpleTestCase;

/**
 * @covers \Robot\Interpreter\FileInterpreter
 */
class FileInterpreterTest extends SimpleTestCase
{
    /**
     * Get files and expected instructions from files that have no unexpected input.
     *
     * @return iterable<string, array<\Robot\Instruct\InstructInterface>> Filepath to input, and list of expected instructions.
     */
    public function getSimpleScenarios(): iterable
    {
        yield 'List of all instructions.' => [
            'examples/all.txt',
            [new Place(1, 2, Direction::SOUTH()), new Left(), new Right(), new Move(), new Report()]
        ];
    }

    /**
     * Test instructions from files that only contain syntactically valid instructions.
     *
     * @dataProvider getSimpleScenarios
     *
     * @param string $inputFile
     * @param array<\Robot\Instruct\InstructInterface> $expected`
     */
    public function testFileConversion(string $inputFile, array $expected): void
    {
        $interpreter = new FileInterpreter(dirname(__DIR__, 3) . '/' . $inputFile);

        $actual = iterator_to_array($interpreter->getInstructions());

        $this->assertEquals($expected, $actual);
    }
}
