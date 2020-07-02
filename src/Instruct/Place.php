<?php
declare(strict_types=1);

namespace Robot\Instruct;

use Robot\Enum\Direction;

/**
 * Instruction to place robot on the board.
 *
 * Note that the instructions are type safe, but may not be valid for the board size.
 */
class Place implements InstructInterface
{
    private Direction $direction;

    /**
     * @var int x co-ordinate location. West to East, with West most side being 0.
     */
    private int $xLoc;

    /**
     * @var int y co-ordinate location. North to South, with South most side being 0.
     */
    private int $yLoc;

    public function __construct(int $xLoc, int $yLoc, Direction $direction)
    {
        $this->xLoc = $xLoc;
        $this->yLoc = $yLoc;
        $this->direction = $direction;
    }

    /**
     * @return Direction
     */
    public function getDirection(): Direction
    {
        return $this->direction;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->xLoc;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->yLoc;
    }
}
