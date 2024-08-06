<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Commands;

use Illuminate\Console\Command;
use Oscabrera\ModelRepository\Classes\Options;
use Oscabrera\ModelRepository\Handlers\MainCommand;
use Oscabrera\ModelRepository\Trait\OptionsTrait;
use Oscabrera\ModelRepository\Trait\PopulatesOptionsTrait;

class Handlers extends Command
{
    use PopulatesOptionsTrait;
    use OptionsTrait;

    /**
     * @var string
     *
     * The name and signature of the console command.
     *  use options:
     *  --seed --migration --service --controller --request -all --force
     */
    protected $signature = 'make:repository {name}
        {--sd|seed : Create a seed file to populate your database
            with sample data}
        {--m|migration : Create a migration file to define the database 
            schema for your model}
        {--f|factory :  Create the class even if the model already exists}
        {--s|service : Create a service class to encapsulate business 
            logic related to your repository operations}
        {--c|controller : Create a controller class that handles incoming 
            API requests and interacts with the service layer}
        {--r|request : Create request classes for validation and data 
            formatting during API interactions}
        {--all : Create all structure for working with the Repository}
        {--force : Overwrites existing files if they already exist}';

    /**
     * @var string
     *
     * The console command description.
     */
    protected $description = 'Create a new model and its repository, 
        with the options for creating all structure for working with 
        the Repository';

    /**
     * Command constructor.
     * Execute the console command.
     */
    public function handle(MainCommand $mainCommand): void
    {
        /** @var string $name */
        $name = $this->argument('name');
        $mainCommand->setOutput($this->components);
        $mainCommand->handle($this, $name, $this->getOptionsCommand());
    }

    /**
     * Retrieve the options from the command input.
     */
    private function getOptionsCommand(): Options
    {
        $optionsList = $this->getOptionsList();
        $optionValues = $this->initializeOptionValues($optionsList);

        foreach ($optionsList as $option => $commandOption) {
            $optionValues[$option] = $this->evaluateOption($commandOption);
        }

        $options = $this->createOptionsObject($optionValues);

        if ($this->shouldForceAll()) {
            $options->forceAll();
        }

        return $options;
    }
}
