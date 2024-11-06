<?php

use Oscabrera\ModelRepository\Exception\Command\CreateStructureException;

it('can be instantiated', function () {
    $exception = new CreateStructureException(
        'already exists',
        'Repository',
        'Repositories/Test/TestRepository.php',
    );

    expect($exception)->toBeInstanceOf(CreateStructureException::class);
});

it('has a message', function () {
    $exception = new CreateStructureException(
        'already exists',
        'Repository',
        'Repositories/Test/TestRepository.php',
    );

    expect($exception->getMessage())->toBe(
        'already exists [Repositories/Test/TestRepository.php]',
    );
});