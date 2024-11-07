<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Classes;

/**
 * Class Options
 *
 * Represents a set of options to control various aspects of functionality.
 */
class Options
{
    public function __construct(
        protected bool $seeder,
        protected bool $migration,
        protected bool $factory,
        protected bool $service,
        protected bool $controller,
        protected bool $request,
        protected bool $force,
    ) {}

    /**
     * Determines if the seeder should be created.
     */
    public function hasSeeder(): bool
    {
        return $this->seeder;
    }

    /**
     * Determines if the migration should be created.
     */
    public function hasMigration(): bool
    {
        return $this->migration;
    }

    /**
     * Determines if the factory should be created.
     */
    public function hasFactory(): bool
    {
        return $this->factory;
    }

    /**
     * Determines if the service should be created.
     */
    public function hasService(): bool
    {
        return $this->service;
    }

    /**
     * Determines if the controller should be created.
     */
    public function hasController(): bool
    {
        return $this->controller;
    }

    /**
     * Determines if the request should be created.
     */
    public function hasRequest(): bool
    {
        return $this->request;
    }

    /**
     * Determines if the operation should be forced.
     */
    public function isForce(): bool
    {
        return $this->force;
    }

    /**
     * Set all force options to true if $all is true.
     */
    public function forceAll(): void
    {
        $this->seeder = true;
        $this->migration = true;
        $this->factory = true;
        $this->service = true;
        $this->controller = true;
        $this->request = true;
    }
}
