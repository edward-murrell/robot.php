<?php
declare(strict_types=1);

namespace Robot\Component;

use Robot\Enum\Direction;
use Robot\Instruct\InstructInterface;
use Robot\Instruct\Left;
use Robot\Instruct\Move;
use Robot\Instruct\Place;
use Robot\Instruct\Right;

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
        } elseif ($instruction instanceof Left) {
            $this->turnLeft();
        } elseif ($instruction instanceof Right) {
            $this->turnRight();
        } elseif ($instruction instanceof Move) {
            $this->move();
        }
    }

    private function place(Place $instruction): void
    {
        if ($this->board->isValidLocation(
            $instruction->getX(),
            $instruction->getY()
        )) {
            $this->xLoc = $instruction->getX();
            $this->yLoc = $instruction->getY();
            $this->direction = $instruction->getDirection();
        }
    }

    private function turnLeft(): void
    {
        if ($this->direction === null) {
            return;
        }
        /** @var int $value */
        $value = $this->direction->getValue();
        $newDirection = (($value - 1 + 4) % 4);
        $this->direction = new Direction($newDirection);
    }

    private function turnRight(): void
    {
        if ($this->direction === null) {
            return;
        }
        /** @var int $value */
        $value = $this->direction->getValue();
        $newDirection = (($value + 1) % 4);
        $this->direction = new Direction($newDirection);
    }

    public function move(): void
    {
        if ($this->direction === null) {
            return;
        }
        if ($this->direction->equals(Direction::NORTH()) &&
            $this->board->isValidLocation($this->xLoc, $this->yLoc + 1)) {
            $this->yLoc++;
        }
        elseif ($this->direction->equals(Direction::SOUTH()) &&
            $this->board->isValidLocation($this->xLoc, $this->yLoc - 1)) {
            $this->yLoc--;
        }
        elseif ($this->direction->equals(Direction::EAST()) &&
            $this->board->isValidLocation($this->xLoc + 1, $this->yLoc)) {
            $this->xLoc++;
        }
        elseif ($this->direction->equals(Direction::WEST()) &&
            $this->board->isValidLocation($this->xLoc - 1, $this->yLoc)) {
            $this->xLoc--;
        }
    }
}
