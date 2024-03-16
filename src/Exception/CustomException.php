<?php

namespace Oscabrera\ModelRepository\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CustomException
 *
 * This exception is thrown when an error related to a text occurs.
 */
class CustomException extends Exception
{
    /**
     * Represents the input parameter of the function.
     *
     * @var array<string|int, mixed> $input
     */
    private array $input;

    /**
     * Represents the title of the error.
     *
     * @var string
     */
    private string $title;

    /**
     * Constructs a new instance of the class.
     *
     * Initializes the object with the provided parameters:
     * - $title (string): The title of the error.
     * - $message (string): The error message.
     * - $input (array): Optional. An array of input data associated with the error. Default is an empty array.
     * - $code (int): Optional. The error code. Default is Response::HTTP_BAD_REQUEST.
     * - $previous (Exception|null): Optional. The previous exception used for the exception chaining. Default is null.
     *
     * @param string $title The title of the error.
     * @param string $message The error message.
     * @param array<string|int, mixed> $input Optional. An array of input data associated with the error.
     *  Default is an empty array.
     *  this used to store the input data who caused the error, not has a structure or typed defined.
     *  For this reason, use mixed
     * @param int $code Optional. The error code. Default is Response::HTTP_BAD_REQUEST.
     * @param Exception|null $previous Optional. The previous exception used for the exception chaining. Default is null.
     */
    public function __construct(
        string $title,
        string $message,
        array $input = [],
        int $code = Response::HTTP_BAD_REQUEST,
        ?Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->title = $title;
        $this->input = $input;
    }

    /**
     * Returns the input data stored in the object.
     *
     * This method returns an array containing the input data stored in the object.
     * The input data represents the information provided to the object during its creation or at a later stage.
     *
     * @return array<string|int, mixed> The input data stored in the object.
     * It is mixed because we can have anything to identify the error
     *
     */
    public function getInput(): array
    {
        return $this->input;
    }

    /**
     * Returns the title of the object.
     *
     * The returned array contains the title of the object.
     *
     * @return string The title of the object.
     */
    public function getTitle(): string
    {
        return $this->title;
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
        return get_class($this) . " [$this->code] $this->title: $this->message\n";
    }
}
