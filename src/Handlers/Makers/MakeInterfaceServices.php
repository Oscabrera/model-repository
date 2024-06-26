<?php

namespace Oscabrera\ModelRepository\Handlers\Makers;

use Oscabrera\ModelRepository\Classes\Options;
use Oscabrera\ModelRepository\Exception\Command\CreateStructureException;
use Oscabrera\ModelRepository\Exception\Command\StubException;

/**
 * Class MakeModel
 *
 * The MakeModel class is responsible for generating a model file and associated migration file
 * using the Laravel Artisan command 'make:model'.
 */
class MakeInterfaceServices extends MakeStructure
{
    /**
     * @var string
     */
    private string $type = 'InterfaceService';

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
            'DummyModel' => $name,
            'DummyClass' => 'I' . $name . 'Service'
        ];
    }

    /**
     * Create a repository file for a given name at the specified path.
     *
     * @param string $name The name of the repository.
     * @param Options $options
     * @return array{type: string, path: string}
     *
     * @throws StubException
     * @throws CreateStructureException
     */
    public function make(string $name, Options $options): array
    {
        $replace = $this->defineReplace($name);
        $directory = app_path("Contracts/Services/$name");
        $path = $this->getFilePath($directory, 'I' . $name, 'Service');

        return $this->createFromClassStub($path, $replace, $this->type, $options);
    }
}
