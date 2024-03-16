<?php

namespace Oscabrera\ModelRepository\Classes;

/**
 * Class Options
 *
 * Represents a set of options to control various aspects of functionality.
 */
class Options
{
    /**
     * @var bool $hasMigration Flag indicating whether a migration is being performed or not.
     */
    public bool $hasMigration = false;

    /**
     * @var bool $hasController Indicates if the controller would be to created
     */
    public bool $hasController = false;

    /**
     * @var bool $hasResource Indicates if the resource would be to created
     */
    public bool $hasResource = false;

    /**
     * @var bool $hasCollection Indicates if the collection would be to created
     */
    public bool $hasCollection = false;

    /**
     * @var bool $hasRequest Indicates if the request would be to created
     */
    public bool $hasRequest = false;

    /**
     * @var bool $hasService Indicates if the service would be to created
     */
    public bool $hasService = false;

    /**
     * @var bool $hasSeeder Indicates if the seeder would be to created
     */
    public bool $hasSeeder = false;
}
