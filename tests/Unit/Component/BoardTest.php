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
}