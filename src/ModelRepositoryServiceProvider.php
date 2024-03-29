<?php

namespace Oscabrera\ModelRepository;

use Illuminate\Support\ServiceProvider;
use Oscabrera\ModelRepository\Commands\Handlers;

class ModelRepositoryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Handlers::class,
            ]);
        }
    }
}
