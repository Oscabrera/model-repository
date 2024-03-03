<?php

namespace ModelRepository\Handlers;

use ModelRepository\Exception\StubException;

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
     * @return array An array of replace keys and values.
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
     * @return string
     * @throws StubException
     */
    public function make(string $name): string
    {
        $replace = $this->defineReplace($name);
        $directory = app_path("Repositories/$name");
        $path = $this->getFilePath($directory, $name, $this->type);
        $stub = $this->getStubPath($this->type);

        return $this->createFromClassStub($stub, $path, $replace, $this->type);
    }
}
