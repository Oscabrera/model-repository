<?php

namespace Oscabrera\ModelRepository\Handlers;

use Illuminate\Console\Command;
use Oscabrera\ModelRepository\Classes\Options;

/**
 * Class MakeModel
 *
 * The MakeModel class is responsible for generating a model file and associated migration file
 * using the Laravel Artisan command 'make:model'.
 */
class MakeModel
{
    /**
     * Executes the make command to generate a model.
     *
     * @param Command $command
     * @param string $name
     * @param Options $options
     * @return void
     */
    public function make(Command $command, string $name, Options $options): void
    {
        $command->call(
            'make:model',
            [
                'name' => $name . '/' . $name,
                '--migration' => $options->hasMigration,
                '--seed' => $options->hasSeeder,
                '--factory' => $options->hasFactory,
                '--force' => $options->force
            ]
        );
    }
}
