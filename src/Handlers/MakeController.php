<?php

namespace ModelRepository\Handlers;

use Illuminate\Console\Command;

/**
 * Class MakeModel
 *
 * The MakeModel class is responsible for generating a model file and associated migration file
 * using the Laravel Artisan command 'make:model'.
 */
class MakeController
{
    /**
     * Constructor method.
     *
     * @param Command $command The Command object used by the class.
     * @param string $name The name parameter of type string.
     * @param bool $hasMigration The hasMigration parameter of type bool.
     *
     * @return void
     */
    public function __construct(
        protected Command $command,
        protected string $name,
        protected bool $hasMigration
    ) {
    }

    /**
     * Executes the make command to generate a model.
     *
     * @return bool
     */
    public function make(): bool
    {
        $this->command->call('make:model', [
            'name' => $this->name,
            '--migration' => $this->hasMigration
        ]);

        return true;
    }
}
