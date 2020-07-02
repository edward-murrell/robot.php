<?php
declare(strict_types=1);

namespace Robot\Tests\Runner;

use Robot\Component\Board;
use Robot\Component\Robot;
use Robot\Enum\Direction;
use Robot\Instruct\Place;
use Robot\Instruct\Report;
use Robot\Tests\Stubs\Interpreter\InterpreterStub;
use Robot\Tests\TestCases\SimpleTestCase;
use Robot\Runner\StringReportingRobotRunner;

/**
 * @cover \Robot\Runner\StringReportingRobotRunner
 */
class StringReportingRobotRunnerTest extends SimpleTestCase
{
    /**
     * When no instructions are given, don't do anything.
     */
    public function testRunnerEmptySet(): void
    {
        $expected = [];
        $interpreter = new InterpreterStub([]);
        $runner = new StringReportingRobotRunner(new Robot(new Board(5, 5)));

        $actual = \iterator_to_array($runner->runInstructions($interpreter));

        $this->assertSame($expected, $actual);
    }

    /**
     * Expect nothing from invalid reports, and multiple reports if valid.
     */
    public function testRunnerReportTwice(): void
    {
        $expected = ['1,2,NORTH', '4,3,SOUTH'];
        $interpreter = new InterpreterStub([
            new Report(),
            new Place(1,2, Direction::NORTH()), new Report(),
            new Place(4,3, Direction::SOUTH()), new Report(),
            new Place(3,1, Direction::SOUTH())
        ]);
        $runner = new StringReportingRobotRunner(new Robot(new Board(5, 5)));

        $actual = \iterator_to_array($runner->runInstructions($interpreter));

        $this->assertSame($expected, $actual);
    }
}
