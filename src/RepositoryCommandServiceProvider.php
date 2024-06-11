<?php

namespace Oscabrera\ModelRepository;

use Illuminate\Support\ServiceProvider;
use Oscabrera\ModelRepository\Commands\Handlers;

class RepositoryCommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
    }

    /**
     * Registers the necessary commands for the application.
     * Only registers the command if the application is running in the console and is in the local environment.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->runningInConsole() && $this->app->isLocal()) {
            $this->commands([
                Handlers::class,
            ]);
        }
    }
}
