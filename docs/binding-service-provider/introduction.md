# BindingServiceProvider

The BindingServiceProvider is a class that facilitates the binding of interfaces and their implementations in a Laravel
project. This implementation follows the SOLID principles, specifically the Dependency Inversion Principle, ensuring
that high-level modules do not depend on low-level modules but on abstractions.

## Configuration File

The binding-provider.php configuration file contains the mappings between interfaces and their implementations. This
file is located in the config directory and is published automatically if it does not exist.

```php
<?php

return [
    'interfaces' => [
        'dummy-model-repository' => [
            'interface' => App\Contracts\Repositories\DummyModel\IDummyModelRepository::class,
            'implementation' => App\Repositories\DummyModel\DummyModelRepository::class,
        ],
        'dummy-model-service' => [
            'interface' => App\Contracts\Services\DummyModel\IDummyModelService::class,
            'implementation' => App\Services\DummyModel\DummyModelService::class,
        ],
    ],
];
```

## Service Provider

The BindingServiceProvider class is responsible for registering the bindings in the Laravel service container. Below is
the code for the class:

```php
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

        $bindings = config('binding-provider.interfaces') ?? [];

        foreach ($bindings as $binding) {
            if (isset($binding['interface'], $binding['implementation'])) {
                $this->app->bind($binding['interface'], $binding['implementation']);
            }
        }
    }
}
```

## SOLID Principles in Repositories and Services

The SOLID principles are a set of design guidelines that help developers create more maintainable, understandable, and
flexible software systems. In the context of repositories and services, these principles encourage the use of interfaces
to achieve a better separation of concerns and more robust code architecture.

1. Single Responsibility Principle (SRP): Each class should have only one reason to change. By using interfaces, we can
   separate the responsibilities of data access (repositories) and business logic (services).

2. Open/Closed Principle (OCP): Software entities should be open for extension but closed for modification. Interfaces
   allow us to extend the functionality of services and repositories without modifying their existing code. New
   implementations can be created to add new behavior.

3. Liskov Substitution Principle (LSP): Objects of a superclass should be replaceable with objects of a subclass without
   affecting the correctness of the program. Interfaces ensure that any implementation of a repository or service can be
   used interchangeably.

4. Interface Segregation Principle (ISP): Clients should not be forced to depend on interfaces they do not use. By
   defining small, specific interfaces for repositories and services, we avoid creating "fat" interfaces that do too
   much.

5. Dependency Inversion Principle (DIP): High-level modules should not depend on low-level modules but on abstractions.
   Using interfaces for repositories and services means that higher-level business logic depends on abstract definitions
   rather than concrete implementations, allowing for easier testing and maintenance.

## Automatic Generation

When creating a repository or service, the corresponding entry should be added to the binding-provider.php configuration
file. This ensures that the new class is properly bound without requiring additional modifications to the service
provider code.

## Example of Automatic Addition

When creating a new repository NewModelRepository and its corresponding interface INewModelRepository, add the following
to the configuration file:

```php
<?php

return [
    'interfaces' => [
        // Other entries
        'new-model-repository' => [
            'interface' => App\Contracts\Repositories\NewModel\INewModelRepository::class,
            'implementation' => App\Repositories\NewModel\NewModelRepository::class,
        ],
        // ...
    ],
];
```

## Conclusion

The BindingServiceProvider automates and organizes the binding of interfaces and their implementations in a Laravel
project, ensuring a clean and maintainable architecture based on the SOLID principles.