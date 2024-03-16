<?php

namespace Oscabrera\ModelRepository\Exception;

/**
 * Class ModelCreateException
 *
 * This exception is thrown when an error occurs while creating a model.
 */
class ModelCreateException extends CustomException
{
    /**
     * Constructor method for the class.
     *
     * @param string $modelName The model name.
     * @param array<string, mixed> $dataEntity The data entity array.
     *
     * @return void
     */
    public function __construct(
        string $modelName,
        array $dataEntity = []
    ) {
        parent::__construct(
            "Create {$modelName} Error",
            "Exist an error to create {$modelName}",
            $dataEntity
        );
    }
}
