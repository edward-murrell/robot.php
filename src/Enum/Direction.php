<?php
declare(strict_types=1);

namespace Robot\Enum;

use MyCLabs\Enum\Enum;

/**
 * Type safe direction for robot facing.
 *
 * @method static \Robot\Enum\Direction NORTH()
 * @method static \Robot\Enum\Direction SOUTH()
 * @method static \Robot\Enum\Direction EAST()
 * @method static \Robot\Enum\Direction WEST()
 */
class Direction extends Enum
{
    private const NORTH = 'NORTH';
    private const SOUTH = 'SOUTH';
    private const EAST = 'EAST';
    private const WEST = 'WEST';
}
