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
     * @var bool $hasController Indicates if the controller is found or not
     */
    public bool $hasController = false;

    /**
     * @var bool $hasResource Indicates if the resource is found or not
     */
    public bool $hasResource = false;

    /**
     * @var bool $hasCollection Indicates if the collection is found or not
     */
    public bool $hasCollection = false;

    /**
     * @var bool $hasRequest Indicates if the request is found or not
     */
    public bool $hasRequest = false;

    /**
     * @var bool $hasService Indicates if the service is found or not
     */
    public bool $hasService = false;

    /**
     * @var bool $hasRepository Indicates if the repository is found or not
     */
    public bool $hasRepository = false;

    /**
     * @var bool $hasInterface Indicates if the interface is found or not
     */
    public bool $hasInterface = false;
}