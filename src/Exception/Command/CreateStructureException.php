<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Exception\Command;

use Oscabrera\ModelRepository\Exception\CustomException;

/**
 * Class CreateStructureException
 *
 * This exception is thrown when there is an error in creating a structure.
 *
 * @package Oscabrera\ModelRepository
 */
class CreateStructureException extends CustomException
{
    /**
     * Constructor method for Error class
     */
    public function __construct(string $message, string $type, string $path)
    {
        parent::__construct(
            "Create {$type} Error",
            "{$message} [{$path}]",
            ['type' => $type, 'path' => $path]
        );
    }
}
