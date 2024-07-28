<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Handlers\Makers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Oscabrera\ModelRepository\Classes\Options;
use Oscabrera\ModelRepository\Exception\Command\CreateStructureException;
use Oscabrera\ModelRepository\Exception\Command\StubException;
use Oscabrera\ModelRepository\Handlers\BindingServices;

class MakeStructure
{
    /**
     * Class constructor.
     */
    public function __construct(
        protected File $file,
        protected BindingServices $bindingServices,
        protected Str $str
    ) {
    }

    /**
     * Creates a class from a stub.
     *
     * @param array<string, string> $replacements
     *
     * @return array{type: string, path: string}
     *
     * @throws StubException|CreateStructureException
     */
    protected function createFromClassStub(
        string $classPath,
        array $replacements,
        string $type,
        Options $options
    ): array {
        $this->validateClassExists($classPath, $type, $options);
        $contentStub = $this->getStubContent($type);
        $classContent = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $contentStub
        );
        file_put_contents($classPath, $classContent);
        return ['type' => $type, 'path' => $classPath];
    }

    /**
     * Validate if the class exists.
     *
     * @throws CreateStructureException If the class already
     * exists and force option is false.
     */
    protected function validateClassExists(
        string $classPath,
        string $type,
        Options $options
    ): void {
        if ($this->file::exists($classPath) && !$options->isForce()) {
            throw new CreateStructureException(
                'already exists',
                $type,
                $classPath
            );
        }
    }

    /**
     * Retrieves the path of the stub file based on the given type.
     */
    protected function getStubPath(string $type): string
    {
        return strval(
            realpath(__DIR__ . '/../../../stubs/' . $type . '.stub')
        );
    }

    /**
     * Retrieves the content of a stub file based on the given type.
     *
     * @throws StubException
     */
    protected function getStubContent(string $type): string
    {
        $stubPath = $this->getStubPath($type);
        if (!file_exists($stubPath)) {
            throw new StubException($type, $stubPath);
        }

        return strval(file_get_contents($stubPath));
    }

    /**
     * Returns the file path for the given directory, name, and type.
     */
    protected function getFilePath(
        string $directory,
        string $name,
        string $type
    ): string {
        if (!$this->file::exists($directory)) {
            $this->file::makeDirectory(
                $directory,
                0755,
                true,
                true
            );
        }
        return $directory . "/{$name}{$type}.php";
    }

    /**
     * Update the configuration file with the given
     *  interface and service classes.
     */
    protected function updateConfigFile(
        string $name,
        string $interfaceClass,
        string $serviceClass
    ): void {
        $this->bindingServices->updateConfigFile(
            $name,
            $interfaceClass,
            $serviceClass
        );
    }

    /**
     * Convert the given name to snake case.
     */
    protected function nameSnakeCase(string $name): string
    {
        return $this->str::snake($name);
    }

    /**
     * Returns the plural form of the given name in snake case.
     */
    protected function namePluralSnakeCase(string $name): string
    {
        return $this->str::plural($this->nameSnakeCase($name));
    }
}
