<?php

namespace ModelRepository\Commands;

use ModelRepository\Classes\Options;
use ModelRepository\Handlers\MainCommand;
use Illuminate\Console\Command;

class Handlers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:structure {name}'
    . ' {--migration} {--service} {--interface} {--controller} {--request} {--resource} {--collection}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create structure for working with repositories';

    /**Command
     * Execute the console command.
     */
    public function handle(MainCommand $mainCommand): void
    {
        $name = $this->argument('name');
        $mainCommand->handle($this, $name, new Options());
    }
}