<?php

namespace Oscabrera\ModelRepository;

use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $configPath = config_path('binding-provider.php');
        if (!file_exists($configPath)) {
            $this->publishes([
                __DIR__ . '/../config/binding-provider.php' => $configPath,
            ], 'config');
        }
    }

    /**
     * Registers the necessary commands for the application.
     * Only registers the command if the application is running in the console and is in the local environment.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/binding-provider.php', 'binding-provider');
        $this->bindInterfaces();
    }

    /**
     * Binds interfaces to their implementations.
     *
     * @return void
     */
    private function bindInterfaces(): void
    {
        $bindings = config('binding-provider.interfaces');
        if (!is_array($bindings)) {
            return;
        }
        foreach ($bindings as $binding) {
            if (isset($binding['interface'], $binding['implementation'])) {
                $this->app->bind($binding['interface'], $binding['implementation']);
            }
        }
    }
}
