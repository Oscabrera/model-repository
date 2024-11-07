<?php

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\MessageBag;
use Oscabrera\DevTools\ClassAccessUtils;
use Symfony\Component\HttpFoundation\Response;

beforeEach(function () {
    $this->classUsingTrait = (new ClassAccessUtils())->getClassUsingTrait('FailedValidationTrait');
});

afterEach(function () {
    unset($this->classUsingTrait);
});

it('handles validation errors correctly', function () {
    $errors = [
        [
            'field' => 'field',
            'title' => 'Failed request validation',
            'message' => 'Invalid data',
            'detail' => ['Invalid data'], // Este es el array correcto
        ],
    ];

    $messageBag = new MessageBag(['field' => ['Invalid data']]);
    $validator = Mockery::mock(Validator::class);
    $validator->shouldReceive('errors')->andReturn($messageBag);

    $responseFactoryMock = $this->createMock(ResponseFactory::class);
    $responseFactoryMock
        ->method('json')
        ->with($this->equalTo(['errors' => $errors]), $this->equalTo(Response::HTTP_UNPROCESSABLE_ENTITY))
        ->willReturn(new JsonResponse(['errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY));

    app()->instance(ResponseFactory::class, $responseFactoryMock);

    try {
        ClassAccessUtils::callPrivateMethod(
            $this->classUsingTrait,
            'failedValidation',
            [$validator],
        );
    } catch (HttpResponseException $e) {
        $response = $e->getResponse();
        expect($response->status())
            ->toBe(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->and($response->getContent())
            ->toBeJson()
            ->and(
                expect(json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR))
                    ->toEqual(['errors' => $errors]),
            );
    }
});

it('Returns formatted errors', function () {
    $errors = [
        'error_field' => ['Error message'],
    ];

    $method = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'formatErrors',
        [$errors],
    );
    expect($method)
        ->toBeArray()
        ->and($method)
        ->toHaveCount(1)
        ->and($method[0])
        ->toBeArray()
        ->and($method[0])
        ->toHaveKeys(['field', 'title', 'message', 'detail'])
        ->toEqual([
            'field' => 'error_field',
            'title' => 'Failed request validation',
            'message' => 'Invalid data',
            'detail' => ['Error message'],
        ]);
});

it('Returns a json response', function () {
    $errors = [
        [
            'field' => 'field',
            'title' => 'Failed request validation',
            'message' => 'Invalid data',
            'detail' => ['Invalid data'], // Este es el array correcto
        ],
    ];

    $responseFactoryMock = $this->createMock(ResponseFactory::class);
    $responseFactoryMock
        ->method('json')
        ->with($this->equalTo(['errors' => $errors]), $this->equalTo(Response::HTTP_UNPROCESSABLE_ENTITY))
        ->willReturn(new JsonResponse(['errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY));

    app()->instance(ResponseFactory::class, $responseFactoryMock);

    try {
        ClassAccessUtils::callPrivateMethod(
            $this->classUsingTrait,
            'infoCommand',
            [$errors],
        );
    } catch (HttpResponseException $exception) {
        $response = $exception->getResponse();
        expect($response->status())
            ->toBe(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->and($response->getContent())
            ->toBeJson()
            ->and(
                expect(json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR))
                    ->toEqual(['errors' => $errors]),
            );
    } catch (Exception $exception) {
        expect(false)->toBeTrue()->because('An unexpected exception was thrown: ' . $exception->getMessage());
    }
});
