<?php
declare(strict_types=1);

namespace Robot\Tests\Component;

use Robot\Component\Board;
use Robot\Component\Robot;
use Robot\Enum\Direction;
use Robot\Instruct\Left;
use Robot\Instruct\Move;
use Robot\Instruct\Place;
use Robot\Instruct\Report;
use Robot\Instruct\Right;
use Robot\Tests\TestCases\SimpleTestCase;

/**
 * @covers \Robot\Tests\Component\Robot
 */
class RobotTest extends SimpleTestCase
{
    /**
     * Return list of instructions for placing a robot, then it's expected locations
     *
     * @return iterable<array<\Robot\Instruct\InstructInterface>,array<int|null,int|null,\Robot\Enum\Direction|null>>
     */
    public function getInstructionLists(): iterable
    {
        yield 'Requesting status of robot before placing returns null' => [
            [],
            null, null, null
        ];

        yield 'Place command sets location.' => [
            [new Move(), new Left(), new Right()],
            null, null, null
        ];

        yield 'Move, Left, Right commands do nothing when the robot has not been placed.' => [
            [new Place(1, 2, Direction::NORTH())],
            Direction::NORTH(), 1, 2
        ];

        yield 'Report instructions are ignored' => [
            [new Report(), new Place(3, 4, Direction::SOUTH()), new Report()],
            Direction::SOUTH(), 3, 4
        ];

        yield 'Invalid placement command is ignored' => [
            [new Place(16, 23, Direction::SOUTH())],
            null, null, null
        ];

        yield 'Multiple invalid placement commands are ignored' => [
            [
                new Place(-1, 23, Direction::SOUTH()),
                new Place(5, 6, Direction::NORTH()),
                new Place(0,  17, Direction::SOUTH())
            ],
            null, null, null
        ];

        yield 'Invalid placement instructions are ignored, but valid are accepted' => [
            [
                new Place(-1, 23, Direction::SOUTH()),
                new Place(0,  4, Direction::EAST()),
                new Place(17, 4, Direction::WEST()),
            ],
            Direction::EAST(), 0, 4
        ];

        yield 'Place robot, and move South and West' => [
            [
                new Place(2, 3, Direction::WEST()),
                new Left(),
                new Move(),
                new Right(),
                new Move(),
            ],
            Direction::WEST(), 1, 2
        ];

        yield 'Place robot North East corner, and try to move off the edge' => [
            [
                new Place(4, 4, Direction::NORTH()),
                new Move(),
                new Right(),
                new Move(),
            ],
            Direction::EAST(), 4, 4
        ];

        yield 'Place robot in South West corner, and try to move off the edge' => [
            [
                new Place(0, 0, Direction::SOUTH()),
                new Move(),
                new Right(),
                new Move(),
            ],
            Direction::WEST(), 0, 0
        ];

        yield 'Test for turning left across modulo boundary' => [
            [
                new Place(0, 0, Direction::NORTH()),
                new Left(),
            ],
            Direction::WEST(), 0, 0
        ];

        yield 'Test for turning right across modulo boundary' => [
            [
                new Place(0, 0, Direction::WEST()),
                new Right(),
            ],
            Direction::NORTH(), 0, 0
        ];
    }

    /**
     * Test instructions result in a location.
     *
     * @param iterable $instructions
     * @param \Robot\Enum\Direction|null $expectedDirection
     * @param int|null $expectedX
     * @param int|null $expectedY
     *
     * @dataProvider getInstructionLists
     */
    public function testRequestingPlace(
        iterable $instructions,
        ?Direction $expectedDirection,
        ?int $expectedX,
        ?int $expectedY
    ): void
    {
        $robot = new Robot(new Board(5, 5));

        foreach ($instructions as $instruction) {
            $robot->command($instruction);
        }

        $this->assertEquals($expectedDirection, $robot->getDirection());
        $this->assertEquals($expectedX, $robot->getXLoc());
        $this->assertEquals($expectedY, $robot->getYLoc());
    }
}
