<?php

use Oscabrera\ModelRepository\Exception\Command\StubException;

it('can be instantiated', function () {
    $exception = new StubException(
        'Repository',
        realpath(__DIR__ . '/../../../stubs/Repository.stub'),
    );

    expect($exception)->toBeInstanceOf(StubException::class);
});

it('has a message', function () {
    $exception = new StubException(
        'Repository',
        realpath(__DIR__ . '/../../../stubs/Repository.stub'),
    );

    expect($exception->getMessage())->toBe(
        'Repository stub file not found in [ ' . realpath(__DIR__ . '/../../../stubs/Repository.stub') . ' ]',
    );
});
