<?php
declare(strict_types=1);

namespace Robot\Tests\Component;

use Robot\Component\Board;
use Robot\Component\Robot;
use Robot\Enum\Direction;
use Robot\Instruct\Left;
use Robot\Instruct\Move;
use Robot\Instruct\Place;
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
        $robot = new Robot(new Board(5, 5));

        $this->assertNull($robot->getDirection());
        $this->assertNull($robot->getXLoc());
        $this->assertNull($robot->getYLoc());
    }

    /**
     * Move, Left, Right commands do nothing when the robot has not been placed.
     */
    public function testRequestingMove(): void
    {
        $robot = new Robot(new Board(5, 5));

        $robot->command(new Move());
        $robot->command(new Left());
        $robot->command(new Right());

        $this->assertNull($robot->getDirection());
        $this->assertNull($robot->getXLoc());
        $this->assertNull($robot->getYLoc());
    }

    /**
     * Place command sets location.
     */
    public function testRequestingPlace(): void
    {
        $robot = new Robot(new Board(5, 5));

        $robot->command(new Place(1, 2, Direction::NORTH()));

        $this->assertEquals(Direction::NORTH(), $robot->getDirection());
        $this->assertEquals(1, $robot->getXLoc());
        $this->assertEquals(2, $robot->getYLoc());
    }
}