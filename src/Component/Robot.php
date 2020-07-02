<?php
declare(strict_types=1);

namespace Robot\Component;

use Robot\Enum\Direction;
use Robot\Instruct\InstructInterface;

class Robot
{
    private ?Direction $direction = null;

    private ?int $xLoc = null;

    private ?int $yLoc = null;

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

    }
}
