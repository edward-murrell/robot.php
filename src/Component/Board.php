<?php
declare(strict_types=1);

namespace Robot\Component;

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
}