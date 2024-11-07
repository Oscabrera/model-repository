<?php

use Oscabrera\ModelRepository\Exception\CustomException;

beforeEach(function () {
    $this->exception = new CustomException(
        'Exception',
        'Test Exception Message',
        ['key' => 'value'],
        404,
        null,
    );
});

it('can be instantiated', function () {
    expect($this->exception)->toBeInstanceOf(CustomException::class);
});


it('has a message', function () {
    expect($this->exception->getMessage())->toBe('Test Exception Message');
});

it('has a code', function () {
    expect($this->exception->getCode())->toBe(404);
});

it('has an input', function () {
    expect($this->exception->getInput())->toBe(['key' => 'value']);
});

it('has a title', function () {
    expect($this->exception->getTitle())->toBe('Exception');
});

it('can be converted to a string', function () {
    expect((string) $this->exception)->toContain(
        "\Exception\CustomException [404] Exception: Test Exception Message\n",
    );
});
