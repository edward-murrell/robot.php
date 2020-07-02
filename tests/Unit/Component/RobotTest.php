<?php
declare(strict_types=1);

namespace Robot\Tests\Component;

use Robot\Component\Robot;
use Robot\Tests\TestCases\SimpleTestCase;

/**
 * @covers \Robot\Tests\Component\Robot
 */
class RobotTest extends SimpleTestCase
{
    /**
     * Requesting status of robot before placing returns null.
     */
    public function testGettersBeforePlacement(): void
    {
        $robot = new Robot();

        $this->assertNull($robot->getDirection());
        $this->assertNull($robot->getXLoc());
        $this->assertNull($robot->getYLoc());
    }
}