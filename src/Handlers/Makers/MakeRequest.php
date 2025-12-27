<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Handlers\Makers;

use Oscabrera\ModelRepository\Classes\Options;
use Oscabrera\ModelRepository\Exception\Command\CreateStructureException;
use Oscabrera\ModelRepository\Exception\Command\StubException;

/**
 * Class MakeModel
 *
 * The MakeModel class is responsible for generating a model file and
 *  associated migration file
 * using the Laravel Artisan command 'make:model'.
 */
class MakeRequest extends MakeStructure
{
    private string $type = 'Request';

    /**
     * Create a repository file for a given name at the specified path.
     *
     * @return array{type: string, path: string}
     *
     * @throws StubException
     * @throws CreateStructureException
     */
    public function make(string $name, Options $options): array
    {
        $replace = $this->defineReplace($name);
        $directory = app_path("Http/Requests/{$name}");
        $path = $this->getFilePath($directory, $name, $this->type);

        return $this->createFromClassStub(
            $path,
            $replace,
            $this->type,
            $options,
        );
    }

    /**
     * Define replace method.
     *
     * This method is used to define and return an array of replace keys and
     *  values.
     *
     * @return array<string, string> An array of replace keys and values.
     */
    private function defineReplace(string $name): array
    {
        return [
            'DummyModel' => $name,
            'DummyClass' => $name . $this->type,
        ];
    }
}
