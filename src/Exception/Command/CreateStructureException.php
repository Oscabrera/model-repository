<?php

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
     *
     * @param string $message The error message
     * @param string $type The type of error
     * @param string $path The path where the error occurred
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
