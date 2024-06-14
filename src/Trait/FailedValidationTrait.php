<?php

namespace Oscabrera\ModelRepository\Trait;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

trait FailedValidationTrait
{
    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = (new ValidationException($validator))->errors();

        $formattedErrors = [];
        foreach ($errors as $field => $message) {
            $formattedErrors[] = [
                'field' => $field,
                'title' => 'Failed request validation',
                "message" => 'Invalid data',
                "detail" => $validator->errors()->all()
            ];
        }

        response()->json([
            'errors' => $formattedErrors,
        ], Response::HTTP_UNPROCESSABLE_ENTITY)->send();
    }
}
