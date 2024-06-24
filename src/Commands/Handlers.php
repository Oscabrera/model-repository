<?php

namespace Oscabrera\ModelRepository\Commands;

use Oscabrera\ModelRepository\Classes\Options;
use Oscabrera\ModelRepository\Handlers\MainCommand;
use Illuminate\Console\Command;

class Handlers extends Command
{
    /**
     * The name and signature of the console command.
     *  use options:
     *  --seed --migration --service --controller --request -all --force
     *
     * @var string
     */
    protected $signature = 'make:repository {name}'
    . ' {--sd|seed : Create a seed file to populate your database with sample data}'
    . ' {--m|migration : Create a migration file to define the database schema for your model}'
    . ' {--f|factory :  Create the class even if the model already exists}'
    . ' {--s|service : Create a service class to encapsulate business logic related to your repository operations}'
    . ' {--c|controller : Create a controller class that handles incoming API requests and interacts with the service layer}'
    . ' {--r|request : Create request classes for validation and data formatting during API interactions}'
    . ' {--all : Create all structure for working with the Repository}'
    . ' {--force : Overwrites existing files if they already exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model and its repository, with the options for '
    . 'creating all structure for working with the Repository'
    . ' with the options for creating all structure for working with the Repository';

    /**Command
     * Execute the console command.
     */
    public function handle(MainCommand $mainCommand): void
    {
        $name = $this->argument('name');
        $mainCommand->setOutput($this->components);
        /** @var string $name */
        $mainCommand->handle($this, $name, new Options());
    }
}
