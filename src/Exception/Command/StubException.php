<?php

declare(strict_types=1);

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
     */
    public function __construct(string $type, string $path)
    {
        parent::__construct(
            "Stub {$type} Error",
            "{$type} stub file not found in [ {$path} ]",
            ['type' => $type, 'path' => $path]
        );
    }
}
