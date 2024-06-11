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
class MakeService extends MakeStructure
{
    /**
     * @var string
     */
    private string $type = 'Service';
    private string $serviceNameSpace = 'App\Services';
    private string $interfaceNameSpace = 'App\Contracts\Services';

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
            'DummyClass' => $name . $this->type,
            'DummyRepository' => 'I' . $name . 'Repository',
            'DummyInterface' => 'I' . $name . $this->type,
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
        $directory = app_path("Services/$name");
        $path = $this->getFilePath($directory, $name, $this->type);

        return $this->createFromClassStub($path, $replace, $this->type, $options->force);
    }

    /**
     * Bind a service implementation to its corresponding interface in the configuration file.
     *
     * @param string $name The name of the service.
     * @return void
     */
    public function binding(string $name): void
    {
        $service = $this->serviceNameSpace . '\\' . $name . '\\' . $name . $this->type;
        $interface = $this->interfaceNameSpace . '\\' . $name . '\\' . 'I' . $name . $this->type;
        $this->updateConfigFile($this->nameSnakeCase($name) . '-service', $interface, $service);
    }
}
