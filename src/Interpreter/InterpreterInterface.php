<?php
declare(strict_types=1);

namespace Robot\Interpreter;

/**
 * Class implementing this interface will issue a list of instructions from an input source.
 *
 * Instructions are not guaranteed to be valid for a given board or order. ie; They may be outside the board limits,
 *  or issue Move/Turn/Report instructions before placement.
 */
interface InterpreterInterface
{
    /**
     * Return a list of valid instructions.
     *
     * This may be an array, but where possible, should be a generator to minimise memory usage.
     *
     * @return iterable<\Robot\Instruct\InstructInterface
     */
    public function getInstructions(): iterable;
}
