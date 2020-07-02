<?php
declare(strict_types=1);

namespace Robot\Component;

use Robot\Enum\Direction;
use Robot\Instruct\InstructInterface;
use Robot\Instruct\Place;

class Robot
{
    private Board $board;

    private ?Direction $direction = null;

    private ?int $xLoc = null;

    private ?int $yLoc = null;

    /**
     * Create a robot with the board it plays on.
     *
     * Robot is not placed on to the board until a valid place command is issued.
     *
     * @param \Robot\Component\Board $board
     */
    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function getDirection(): ?Direction
    {
        return $this->direction;
    }
    public function getXLoc(): ?int
    {
        return $this->xLoc;
    }

    public function getYLoc(): ?int
    {
        return $this->yLoc;
    }

    /**
     * Pass commmands to the robot. Invalid commands will be ignored, without error.
     */
    public function command(InstructInterface $instruction): void
    {
        if ($instruction instanceof Place) {
            $this->place($instruction);
        }
    }

    private function place(Place $instruction): void
    {
        if ($instruction->getX() >= 0 &&
            $instruction->getY() >= 0 &&
            $instruction->getX() < $this->board->getHeight() &&
            $instruction->getY() < $this->board->getHeight()
        ) {
            $this->xLoc = $instruction->getX();
            $this->yLoc = $instruction->getY();
            $this->direction = $instruction->getDirection();
        }
    }
}
