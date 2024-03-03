<?php

namespace Oscabrera\ModelRepository\Handlers;

use Oscabrera\ModelRepository\Exception\StubException;

/**
 * Class MakeModel
 *
 * The MakeModel class is responsible for generating a model file and associated migration file
 * using the Laravel Artisan command 'make:model'.
 */
class MakeService extends MakeStructure
{
    /**
     * @var string
     */
    private string $type = 'Service';

    protected bool $hasInterface;

    /**
     * Define replace method.
     *
     * This method is used to define and return an array of replace keys and values.
     *
     * @return array An array of replace keys and values.
     */
    private function defineReplace(string $name): array
    {
        $replace = [
            'DummyClass' => $name . $this->type,
            'DummyRepository' => $name . 'Repository',
            'DummyModel' => $name
        ];
        if ($this->hasInterface) {
            $replace['DummyInterface'] = 'I' . $name . 'Interface';
        }
        return $replace;
    }

    /**
     * Create a repository file for a given name at the specified path.
     *
     * @param string $name The name of the repository.
     * @param bool $hasInterface
     * @return string
     * @throws StubException
     */
    public function make(string $name, bool $hasInterface): string
    {
        $this->hasInterface = $hasInterface;
        $replace = $this->defineReplace($name);
        $directory = app_path("Services/$name");
        $path = $this->getFilePath($directory, $name, $this->type);
        $stub = $hasInterface ? $this->getStubPath($this->type . 'WhitInterface') : $this->getStubPath($this->type);

        return $this->createFromClassStub($stub, $path, $replace, $this->type);
    }
}
