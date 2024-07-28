<?php

namespace Oscabrera\ModelRepository\Trait;

use Oscabrera\ModelRepository\Contracts\BindingInterface;
use Oscabrera\ModelRepository\Exception\Command\CreateStructureException;
use Oscabrera\ModelRepository\Exception\Command\StubException;
use Oscabrera\ModelRepository\Handlers\Makers\MakeController;
use Oscabrera\ModelRepository\Handlers\Makers\MakeInterfaceRepository;
use Oscabrera\ModelRepository\Handlers\Makers\MakeInterfaceServices;
use Oscabrera\ModelRepository\Handlers\Makers\MakeRepository;
use Oscabrera\ModelRepository\Handlers\Makers\MakeRequest;
use Oscabrera\ModelRepository\Handlers\Makers\MakeService;

trait MainCommandTrait
{
    /**
     * @var array<int, class-string>
     */
    private array $hasBinding = [
        MakeRepository::class,
        MakeService::class,
    ];

    /**
     * Executes the Maker.
     *
     * This method executes a Maker by calling its `make` method with the given options.
     * If the `bind` parameter is set to `true`, it also calls the Maker's `binding` method.
     */
    private function executeMaker(
        MakeRepository|MakeInterfaceRepository|MakeService|MakeInterfaceServices|MakeController|MakeRequest $maker,
    ): void {
        try {
            $result = $maker->make($this->name, $this->options);
            if (
                in_array($maker::class, $this->hasBinding, true) &&
                $maker instanceof BindingInterface
            ) {
                $maker->binding($this->name);
            }
            $this->infoCommand($result);
        } catch (StubException|CreateStructureException $exception) {
            $info = $exception->getInput();
            /** @var array{type: string, path: string} $info */
            $this->errorCommand($exception->getMessage(), $info);
        }
    }
}
