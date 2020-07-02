<?php
declare(strict_types=1);

namespace Robot\Tests\Component;

use Robot\Component\Board;
use Robot\Tests\TestCases\SimpleTestCase;

/**
 * @covers \Robot\Tests\Component\Board
 */
class BoardTest extends SimpleTestCase
{
    /**
     * Test board getters.
     */
    public function testGetters(): void
    {
        $board = new Board(4, 3);

        $this->assertSame(4, $board->getWidth());
        $this->assertSame(3, $board->getHeight());
    }

    /**
     * Get scenarios for requests if a given location is valid.
     *
     * @return iterable<array<\Robot\Component\Board,int,int,bool>>
     */
    public function getValidScenarios(): iterable
    {
        yield [new Board(5, 5), 0, 0, true];
        yield [new Board(5, 5), 1, 3, true];
        yield [new Board(5, 5), 4, 4, true];
        yield [new Board(4, 4), 4, 4, false];
        yield [new Board(3, 3), 4, 4, false];
        yield [new Board(5, 5), 5, 0, false];
        yield [new Board(5, 5), 0, 5, false];
        yield [new Board(5, 5), 5, 5, false];
        yield [new Board(5, 5), 0, 15, false];
        yield [new Board(5, 5), -3, -2, false];
    }

    /**
     * Tests a set of locations are valid.
     *
     * @param \Robot\Component\Board $board
     * @param int $x X location on East / West
     * @param int $y Y location on North / South
     * @param bool $expected Expected response from isValidLocation
     *
     * @dataProvider getValidScenarios
     */
    public function testIsValidLocation(Board $board, int $x, int $y, bool $expected): void
    {
        self::assertEquals($expected, $board->isValidLocation($x, $y));
    }
}
