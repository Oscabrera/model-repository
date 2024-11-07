<?php

use Oscabrera\DevTools\ClassAccessUtils;
use Oscabrera\ModelRepository\Classes\Options;

beforeEach(function () {
    $this->classUsingTrait = (new ClassAccessUtils())->getClassUsingTrait('PopulatesOptionsTrait');
});

afterEach(function () {
    unset($this->classUsingTrait);
});

it('Gets the options list', function () {
    $result = ClassAccessUtils::callPrivateMethod($this->classUsingTrait, 'getOptionsList');

    expect($result)->toBe([
        'hasSeeder' => ['seed', 'sd'],
        'hasMigration' => ['migration', 'm'],
        'hasFactory' => ['factory', 'f'],
        'hasService' => ['service', 's'],
        'hasController' => ['controller', 'c'],
        'hasRequest' => ['request', 'r'],
        'force' => 'force',
    ]);
});

it('Initializes the option values', function () {
    $optionsList = [
        'hasSeeder' => ['seed', 'sd'],
        'hasMigration' => ['migration', 'm'],
        'hasFactory' => ['factory', 'f'],
        'hasService' => ['service', 's'],
        'hasController' => ['controller', 'c'],
        'hasRequest' => ['request', 'r'],
        'force' => 'force',
    ];
    $result = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'initializeOptionValues',
        [$optionsList],
    );
    expect($result)->toBe([
        'hasSeeder' => false,
        'hasMigration' => false,
        'hasFactory' => false,
        'hasService' => false,
        'hasController' => false,
        'hasRequest' => false,
        'force' => false,
    ]);
});

it('Creates an Options object', function () {
    $optionsValues = [
        'hasSeeder' => true,
        'hasMigration' => true,
        'hasFactory' => true,
        'hasService' => false,
        'hasController' => false,
        'hasRequest' => false,
        'force' => true,
    ];
    $result = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'createOptionsObject',
        [$optionsValues],
    );

    expect($result)->toBeInstanceOf(Options::class)
        ->and($result->hasSeeder())->toBeTrue()
        ->and($result->hasMigration())->toBeTrue()
        ->and($result->hasFactory())->toBeTrue()
        ->and($result->hasService())->toBeFalse()
        ->and($result->hasController())->toBeFalse()
        ->and($result->hasRequest())->toBeFalse()
        ->and($result->isForce())->toBeTrue();
});

it('Returns false if the "all" option is false', function () {
    $this->classUsingTrait->setOptions(['all' => false]);
    $result = ClassAccessUtils::callPrivateMethod($this->classUsingTrait, 'shouldForceAll');
    expect($result)->toBeFalse();
});

it('Returns true if the "all" option is true', function () {
    $this->classUsingTrait->setOptions(['all' => true]);
    $result = ClassAccessUtils::callPrivateMethod($this->classUsingTrait, 'shouldForceAll');
    expect($result)->toBeTrue();
});

it('Returns false if the "all" option is not set ', function () {
    $this->classUsingTrait->setOptions([]);
    $result = ClassAccessUtils::callPrivateMethod($this->classUsingTrait, 'shouldForceAll');

    expect($result)->toBeFalse();
});

it('Tests the "force" option', function () {
    $optionsValues = [
        'hasSeeder' => false,
        'hasMigration' => false,
        'hasFactory' => false,
        'hasService' => false,
        'hasController' => false,
        'hasRequest' => false,
        'force' => false,
        'all' => true,
    ];
    $option = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'createOptionsObject',
        [$optionsValues],
    );
    $option->forceAll();

    expect($option)->toBeInstanceOf(Options::class)
        ->and($option->hasSeeder())->toBeTrue()
        ->and($option->hasMigration())->toBeTrue()
        ->and($option->hasFactory())->toBeTrue()
        ->and($option->hasService())->toBeTrue()
        ->and($option->hasController())->toBeTrue()
        ->and($option->hasRequest())->toBeTrue()
        ->and($option->isForce())->toBeFalse();
});
