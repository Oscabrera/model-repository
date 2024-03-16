<?php

namespace Oscabrera\ModelRepository\Handlers;

use Illuminate\Console\Command;

/**
 * Class MakeSeeder
 *
 * The MakeSeeder class is responsible for generating a seeder file using the Laravel Artisan command 'make:seeder'.
 */
class MakeSeeder
{
    /**
     * Executes the make command to generate a model.
     *
     * @param Command $command
     * @param string $name
     * @return void
     */
    public function make(Command $command, string $name): void
    {
        $command->call('make:seeder', [
            'name' => $name . 'Seeder',
        ]);
    }
}
