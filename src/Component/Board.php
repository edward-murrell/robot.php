<?php
declare(strict_types=1);

namespace Robot\Component;

/**
 * Value holder for a simple square board.
 */
class Board
{
    /**
     * @var int The total size of the board on the North/South (y) axis.
     */
    private int $height;

    /**
     * @var int The total size of the board on the East/West (x) axis.
     */
    private int $width;

    /**
     * @param int $width  East/West (x) size.
     * @param int $height North/South (y) size.
     */
    public function __construct(int $width, int $height)
    {
        $this->height = $height;
        $this->width = $width;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Calculates if a given location is a valid location on the board.
     *
     * @param int|null $xLoc X location on East / West, where 0 is West.
     * @param int|null $yLoc Y location on North / South, where 0 is South.
     *
     * @return bool True if location is valid, false if not.
     */
    public function isValidLocation(?int $xLoc, ?int $yLoc): bool
    {
        if ($xLoc === null || $yLoc === null) {
            return false;
        }
        return (
            $xLoc >= 0 &&
            $yLoc >= 0 &&
            $xLoc < $this->getWidth() &&
            $yLoc < $this->getHeight()
        );
    }
}