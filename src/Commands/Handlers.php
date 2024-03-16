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
     *  --seed --migration --service --interface --controller --request --resource --collection
     *
     * @var string
     */
    protected $signature = 'make:repository {name}'
    . ' {--seed} {--migration} {--service} {--controller} {--request} {--resource} {--collection}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model and its repository, with the options for '
    . 'creating all structure for working with the Repository';

    /**Command
     * Execute the console command.
     */
    public function handle(MainCommand $mainCommand): void
    {
        $name = $this->argument('name');
        $mainCommand->setOutput($this->components);
        $mainCommand->handle($this, $name, new Options());
    }
}
