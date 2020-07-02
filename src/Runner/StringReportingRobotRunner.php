<?php
declare(strict_types=1);

namespace Robot\Runner;

use Robot\Component\Robot;
use Robot\Interpreter\InterpreterInterface;
use Robot\Tests\TestCases\SimpleTestCase;

/**
 * A robot runner that returns a list of plain text reports.
 */
class StringReportingRobotRunner extends SimpleTestCase
{
    private Robot $robot;

    public function __construct(Robot $robot)
    {
        $this->robot = $robot;
    }

    public function runInstructions(InterpreterInterface $interpreter): iterable
    {
        foreach ($interpreter->getInstructions() as $instruction) {
            yield;
        }
    }
}
