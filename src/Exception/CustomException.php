<?php

namespace Oscabrera\ModelRepository\Exception;

/**
 * Class CustomException
 *
 * This exception is thrown when an error related to a text occurs.
 */

use Exception;

class CustomException extends Exception
{
    /**
     * Represents the input parameter of the function.
     *
     * @var array<string, mixed> $input
     */
    private array $input;

    /**
     * Constructs a new exception.
     *
     * @param string $message The error message.
     * @param int $code The error code. (Optional)
     * @param Exception|null $previous The previous exception used for chaining. (Optional)
     * @param array<string, mixed> $input The input array. (Optional)
     */
    public function __construct(string $message, int $code = 500, ?Exception $previous = null, array $input = [])
    {
        parent::__construct($message, $code, $previous);
        $this->input = $input;
    }

    /**
     * Returns the input data stored in the object.
     *
     * This method returns an array containing the input data stored in the object.
     * The input data represents the information provided to the object during its creation or at a later stage.
     *
     * @return array<string, mixed> The input data stored in the object.
     */
    public function getInput(): array
    {
        return $this->input;
    }

    /**
     * Returns a string representation of the object.
     *
     * The returned string includes the name of the class, the error code, and the error message.
     *
     * @return string A string representation of the object.
     */
    public function __toString(): string
    {
        return get_class($this) . ": [$this->code]: $this->message\n";
    }
}
