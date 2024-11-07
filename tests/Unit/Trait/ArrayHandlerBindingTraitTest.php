<?php

use Oscabrera\DevTools\ClassAccessUtils;

beforeEach(function () {
    $this->classUsingTrait = (new ClassAccessUtils())->getClassUsingTrait('ArrayHandlerBindingTrait');
});


it('Returns formatted class reference', function () {
    $result = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'formatClassReference',
        ['interface', 'App\Contracts\Services\Level\ILevelService', '    '],
    );
    expect($result)->toBe("    'interface' => App\Contracts\Services\Level\ILevelService::class,");
});

it('Checks if the given key is an interface or implementation', function () {
    $result = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'isInterface',
        ['interface'],
    );
    expect($result)->toBeTrue();
    $result = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'isInterface',
        ['implementation'],
    );
    expect($result)->toBeTrue();
    $result = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'isInterface',
        ['something else'],
    );
    expect($result)->toBeFalse();
});

it('Formats the configuration file', function () {
    $newBindings = [
        'interfaces' => [
            'user-repository' => [
                'interface' => 'App\Repositories\User\IUserRepository',
                'implementation' => 'App\Contracts\Repositories\User\UserRepository',
            ],
        ],
    ];
    $result = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'formatConfigFile',
        [['interfaces' => []], $newBindings],
    );
    expect($result)
        ->toContain('interfaces')
        ->and($result)->toContain('user-repository')
        ->and($result)->toContain('interface')
        ->and($result)->toContain('implementation')
        ->and($result)->toContain('App\Contracts\Repositories\User\UserRepository')
        ->and($result)->toContain('App\Repositories\User\IUserRepository');
});

it('Adds new bindings', function () {
    $configStart = [
        'simple-key' => 'simple-value',
        'interfaces' => [
            'level-repository' => [
                'interface' => 'App\Repositories\Level\ILevelRepository',
                'implementation' => 'App\Contracts\Repositories\Level\LevelRepository',
            ],
        ],
    ];
    $newBindings = [
        'user-repository' => [
            'interface' => 'App\Repositories\User\IUserRepository',
            'implementation' => 'App\Contracts\Repositories\User\UserRepository',
        ],
    ];
    $result = ClassAccessUtils::callPrivateMethod(
        $this->classUsingTrait,
        'formatConfigFile',
        [$configStart, $newBindings],
    );
    expect($result)
        ->toBeString()
        ->toContain('interfaces')
        ->and($result)->toContain('user-repository')
        ->and($result)->toContain('interface')
        ->and($result)->toContain('implementation')
        ->and($result)->toContain('App\Contracts\Repositories\User\UserRepository')
        ->and($result)->toContain('App\Repositories\User\IUserRepository');
});
