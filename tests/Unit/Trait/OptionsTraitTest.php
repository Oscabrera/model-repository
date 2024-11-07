<?php

use Oscabrera\DevTools\ClassAccessUtils;

beforeEach(function () {
    $this->classUsingTrait = (new ClassAccessUtils())->getClassUsingTrait('OptionsTrait');
});

afterEach(function () {
    unset($this->classUsingTrait);
});

it('Seeds is false', function () {
    $initialValue = [
        'seed' => false,
        'migration' => true,
        'f' => true,
    ];
    $this->classUsingTrait->setOptions($initialValue);
    $resultHasSeeder = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'evaluateOption',
        ['seed'],
    );
    expect($resultHasSeeder)->toBeFalse();
});

it('Migration is true', function () {
    $initialValue = [
        'seed' => false,
        'migration' => true,
        'f' => true,
    ];
    $this->classUsingTrait->setOptions($initialValue);
    $resultHasMigration = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'evaluateOption',
        ['migration'],
    );
    expect($resultHasMigration)->toBeTrue();
});

it('Use f as factory, f is true', function () {
    $initialValue = [
        'seed' => false,
        'migration' => true,
        'f' => true,
    ];
    $this->classUsingTrait->setOptions($initialValue);
    $resultHasFactory = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'evaluateOption',
        [['f', 'factory']],
    );
    expect($resultHasFactory)->toBeTrue();
});

it('Service is not set, ', function () {
    $initialValue = [
        'seed' => false,
        'migration' => true,
        'f' => true,
    ];
    $this->classUsingTrait->setOptions($initialValue);
    $resultHasFactory = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'evaluateOption',
        [['service', 's']],
    );
    expect($resultHasFactory)->toBeFalse();
});

it('Evaluate option with empty array', function () {
    $initialValue = [
        'seed' => false,
        'migration' => true,
        'f' => true,
    ];
    $this->classUsingTrait->setOptions($initialValue);
    $result = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'evaluateOption',
        [[]],
    );
    expect($result)->toBeFalse();
});

it('Evaluate if option all', function () {
    $initialValue = [
        'seed' => false,
        'migration' => true,
        'all' => true,
    ];
    $this->classUsingTrait->setOptions($initialValue);
    $result = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'evaluateOption',
        ['all'],
    );

    expect($result)->toBeTrue();
});
