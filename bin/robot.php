#!/usr/bin/php
<?php
declare(strict_types=1);

namespace RobotRunner;

use Robot\Component\Board;
use Robot\Component\Robot;
use Robot\Interpreter\FileInterpreter;
use Robot\Runner\StringReportingRobotRunner;

require_once dirname(__DIR__ ) . '/vendor/autoload.php';

$interpreter = new FileInterpreter($argv[1]);
$runner = new StringReportingRobotRunner(new Robot(new Board(5, 5)));

foreach ($runner->runInstructions($interpreter) as $output) {
    echo "{$output}\n";
}
