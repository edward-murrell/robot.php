<?php
declare(strict_types=1);

namespace Robot\Tests\Stubs\Interpreter;

use Robot\Interpreter\InterpreterInterface;

/**
 * Interpreter stub to allow seeding instructions without reading file.
 *
 * @coversNothing
 */
class InterpreterStub implements InterpreterInterface
{
    /**
     * @var array<\Robot\Instruct\InstructInterface>
     */
    private array $instructions;

    public function __construct(array $instructions)
    {
        $this->instructions = $instructions;
    }

    /**
     * {@inheritdoc}
     */
    public function getInstructions(): iterable
    {
        return $this->instructions;
    }
}
