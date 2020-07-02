<?php
declare(strict_types=1);

namespace Robot\Tests\Unit\Instruct;

use Robot\Enum\Direction;
use Robot\Instruct\Place;
use Robot\Tests\TestCases\SimpleTestCase;

/**
 * @covers \Robot\Instruct\Place
 */
class PlaceTest extends SimpleTestCase
{
    /**
     * Test DTO returns the same data it was constucted with.
     */
    public function testGetters(): void
    {
        $place = new Place(42, -1, Direction::SOUTH());

        $this->assertEquals(42, $place->getX());
        $this->assertEquals(-1, $place->getY());
        $this->assertEquals(Direction::SOUTH(), $place->getDirection());
    }
}