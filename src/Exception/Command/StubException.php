<?php

namespace Oscabrera\ModelRepository\Exception\Command;

use Oscabrera\ModelRepository\Exception\CustomException;

/**
 * Class StubException
 *
 * This class represents an exception that is thrown when a stub is not found.
 * It extends the CustomException class.
 */
class StubException extends CustomException
{
    /**
     * Class constructor.
     *
     * @param string $type The type of stub.
     * @param string $path The path to the stub.
     *
     * @return void
     */
    public function __construct(string $type, string $path)
    {
        parent::__construct(
            "Stub {$type} Error",
            "{$type} stub file not found in [" . $path . "]",
            ['type' => $type, 'path' => $path]
        );
    }
}
