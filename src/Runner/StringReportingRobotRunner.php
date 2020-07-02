<?php
declare(strict_types=1);

namespace Robot\Runner;

use Robot\Component\Robot;
use Robot\Instruct\Report;
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

    /**
     * Run a set of instructions on the robot, and return any report responses.
     *
     * @param \Robot\Interpreter\InterpreterInterface $interpreter
     *
     * @return \Traversable<string>
     */
    public function runInstructions(InterpreterInterface $interpreter): \Traversable
    {
        foreach ($interpreter->getInstructions() as $instruction) {
            $this->robot->command($instruction);
            if ($instruction instanceof Report && $this->robot->getDirection() !== null) {
                yield $this->createReportString($this->robot);
            }
        }
    }

    /**
     * Create a report string in the format of X,Y,DIRECTION.
     *
     * NOTE: This method takes the robot as a method parameter to ease future refactoring.
     */
    private function createReportString(Robot $robot): string
    {
        return \sprintf('%s,%s,%s', $robot->getXLoc(), $robot->getYLoc(), $robot->getDirection()->getKey());
    }
}
