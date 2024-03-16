<?php

namespace Oscabrera\ModelRepository\Handlers;

use Oscabrera\ModelRepository\Exception\CreateStructureException;
use Oscabrera\ModelRepository\Exception\StubException;

/**
 * Class MakeModel
 *
 * The MakeModel class is responsible for generating a model file and associated migration file
 * using the Laravel Artisan command 'make:model'.
 */
class MakeRepository extends MakeStructure
{
    private string $type = 'Repository';

    /**
     * Define replace method.
     *
     * This method is used to define and return an array of replace keys and values.
     *
     * @return array<string, string> An array of replace keys and values.
     */
    private function defineReplace(string $name): array
    {
        return [
            'DummyClass' => $name . $this->type,
            'DummyModel' => $name,
        ];
    }

    /**
     * Create a repository file for a given name at the specified path.
     *
     * @param string $name The name of the repository.
     * @return array{type: string, path: string}
     *
     * @throws StubException
     * @throws CreateStructureException
     */
    public function make(string $name): array
    {
        $replace = $this->defineReplace($name);
        $directory = app_path("Repositories/$name");
        $path = $this->getFilePath($directory, $name, $this->type);

        return $this->createFromClassStub($path, $replace, $this->type);
    }
}
