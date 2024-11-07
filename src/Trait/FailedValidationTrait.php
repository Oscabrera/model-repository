<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Trait;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

trait FailedValidationTrait
{
    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = (new ValidationException($validator))->errors();

        $formattedErrors = $this->formatErrors($errors);
        $this->infoCommand($formattedErrors);
    }

    /**
     * formatErrors method takes an array of errors and formats them into a standardized format.
     *
     * @param array<string, array<int, string>> $errors The array of errors to be formatted.
     *
     * @return array<int, array{field: string, title: string, message: string, detail: array<int, string>}>
     * The formatted errors in the form of an array of associative arrays.
     */
    private function formatErrors(array $errors): array
    {
        $formattedErrors = [];
        foreach ($errors as $field => $message) {
            $formattedErrors[] = [
                'field' => $field,
                'title' => 'Failed request validation',
                'message' => 'Invalid data',
                'detail' => $message,
            ];
        }
        return $formattedErrors;
    }

    /**
     * infoCommand method throws an HttpResponseException with a JSON response containing formatted errors.
     *
     * @param array<int, array{
     *     field: string,
     *     title: string,
     *     message: string,
     *     detail: array<int, string>
     *         }> $formattedErrors
     * The formatted errors to be included in the JSON response.
     *
     * @throws HttpResponseException When called, it throws an HttpResponseException.
     */
    private function infoCommand(array $formattedErrors): void
    {
        throw new HttpResponseException(
            response()->json(
                ['errors' => $formattedErrors],
                Response::HTTP_UNPROCESSABLE_ENTITY,
            ),
        );
    }
}
