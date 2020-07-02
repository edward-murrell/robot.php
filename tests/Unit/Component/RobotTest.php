<?php
declare(strict_types=1);

namespace Robot\Tests\Component;

use Robot\Component\Robot;
use Robot\Instruct\Left;
use Robot\Instruct\Move;
use Robot\Instruct\Right;
use Robot\Tests\TestCases\SimpleTestCase;

/**
 * @covers \Robot\Tests\Component\Robot
 */
class RobotTest extends SimpleTestCase
{
    /**
     * Requesting status of robot before placing returns null.
     */
    public function testGettersBeforePlacement(): void
    {
        $robot = new Robot();

        $this->assertNull($robot->getDirection());
        $this->assertNull($robot->getXLoc());
        $this->assertNull($robot->getYLoc());
    }

    /**
     * Move, Left, Right commands do nothing when the robot has not been placed.
     */
    public function testRequestingMove(): void
    {
        $robot = new Robot();

        $robot->command(new Move());
        $robot->command(new Left());
        $robot->command(new Right());

        $this->assertNull($robot->getDirection());
        $this->assertNull($robot->getXLoc());
        $this->assertNull($robot->getYLoc());
    }
}