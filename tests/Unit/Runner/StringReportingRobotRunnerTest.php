<?php
declare(strict_types=1);

namespace Robot\Tests\Runner;

use Robot\Component\Board;
use Robot\Component\Robot;
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
}
