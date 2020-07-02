<?php
declare(strict_types=1);

namespace Robot\Interpreter;

use Exception;
use Robot\Enum\Direction;
use Robot\Instruct\InstructInterface;
use Robot\Instruct\Left;
use Robot\Instruct\Move;
use Robot\Instruct\Place;
use Robot\Instruct\Report;
use Robot\Instruct\Right;

class FileInterpreter implements InterpreterInterface
{
    /**
     * @var resource File handle for file to be read.
     */
    private $fileHandle;

    /**
     * Create an interpreter for a local file.
     *
     * @param string $filepath Path to file of Robot move instructions.
     *
     * @throws \Exception Thrown if file could not be opened.
     */
    public function __construct(string $filepath)
    {
        if (is_readable($filepath) === false ||
            !$handle = fopen($filepath, 'r')) {
            throw new Exception("Could not open {$filepath}");
        }
        $this->fileHandle = $handle;
    }

    public function __destruct()
    {
        fclose($this->fileHandle);
    }

    /**
     * Get list of instructions from the input file.
     *
     * @return \Traversable<\Robot\Instruct\InstructInterface>
     */
    public function getInstructions(): \Traversable
    {
        while ($line = fgets($this->fileHandle)) {
            $instruction = $this->convertLine($line);
            if ($instruction !== null) {
                yield $instruction;
            }
        }
        fseek($this->fileHandle, 0);
    }

    /**
     * Convert a line into an instruction.
     *
     * Null is returned if the instruction is not valid.
     */
    private function convertLine(string $line): ?InstructInterface
    {
        $matches = [];
        if (0 === preg_match(
        '/^(MOVE|LEFT|RIGHT|REPORT)|(?:(PLACE)\s+(\d+)\,(\d+)\,(NORTH|SOUTH|EAST|WEST))/',
                $line,
                $matches
            )) {
                return null;
            }
        switch ($matches[1]) {
            // It's possible to replace this with something like `new matches[0]`, but it breaks type safety.
            case 'MOVE':
                return new Move();
            case 'LEFT':
                return new Left();
            case 'RIGHT':
                return new Right();
            case 'REPORT':
                return new Report();
        }
        switch ($matches[2]) {
            case 'PLACE':
                $directionInt = new Direction(Direction::values()[$matches[5]]);
                return new Place((int) $matches[3], (int) $matches[4], new Direction($directionInt));
        }
        throw new Exception('Unexpected unknown instruction in file interpreter.');
    }
}