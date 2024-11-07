<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Oscabrera\ModelRepository\Commands\Handlers;

/**
 * Service provider for registering repository commands
 */
class RepositoryCommandServiceProvider extends ServiceProvider
{
    public function boot(): void {}

    public function register(): void
    {
        if (
            $this->app instanceof LaravelApplication
            && $this->app->runningInConsole() && $this->app->isLocal()
        ) {
            $this->commands([
                Handlers::class,
            ]);
        }
    }
}
