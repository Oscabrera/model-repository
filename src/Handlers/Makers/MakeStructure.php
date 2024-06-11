<?php

namespace Oscabrera\ModelRepository\Handlers\Makers;

use Illuminate\Support\Facades\File;
use Oscabrera\ModelRepository\Exception\Command\CreateStructureException;
use Oscabrera\ModelRepository\Exception\Command\StubException;
use Oscabrera\ModelRepository\Handlers\BindingServices;
use Str;

class MakeStructure
{
    /**
     * Initializes a new instance of the class.
     *
     * @param File $file The file object to be used by the constructor.
     *
     * @return void
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
     * @param string $classPath
     * @param array<string, string> $replacements
     * @param string $type
     * @param bool $force Determines if the class should be overwritten if it already exists.
     * @return array{type: string, path: string}
     * @throws StubException|CreateStructureException
     */
    protected function createFromClassStub(
        string $classPath,
        array $replacements,
        string $type,
        bool $force = false
    ): array {
        if ($this->file::exists($classPath) && !$force) {
            throw new CreateStructureException('already exists', $type, $classPath);
        }

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
     * Retrieves the path of the stub file based on the given type.
     *
     * @param string $type The type of the stub file.
     *
     * @return string The path of the stub file.
     */
    protected function getStubPath(string $type): string
    {
        return strval(realpath(__DIR__ . '/../../../stubs/' . $type . '.stub'));
    }

    /**
     * Retrieves the content of a stub file based on the given type.
     *
     * @param string $type The type of the stub.
     *
     * @return string The content of the stub file.
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
     *
     * @param string $directory The directory where the file will be located.
     * @param string $name The name of the file.
     * @param string $type The type of the file.
     *
     * @return string The file path.
     */
    protected function getFilePath(string $directory, string $name, string $type): string
    {
        if (!$this->file::exists($directory)) {
            $this->file::makeDirectory($directory, 0755, true, true);
        }
        return $directory . "/{$name}{$type}.php";
    }

    /**
     * Update the configuration file with the given interface and service classes.
     *
     * @param string $name The name of the binding.
     * @param string $interfaceClass The fully qualified class name of the interface.
     * @param string $serviceClass The fully qualified class name of the service.
     * @return void
     */
    protected function updateConfigFile(string $name, string $interfaceClass, string $serviceClass): void
    {
        $this->bindingServices->updateConfigFile($name, $interfaceClass, $serviceClass);
    }

    /**
     * Convert the given name to snake case.
     *
     * @param string $name The name to be converted.
     * @return string The converted name in snake case.
     */
    protected function nameSnakeCase(string $name): string
    {
        return $this->str::snake($name);
    }

    /**
     * Returns the plural form of the given name in snake case.
     *
     * @param string $name The name to convert to plural snake case.
     * @return string The plural form of the given name in snake case.
     */
    protected function namePluralSnakeCase(string $name): string
    {
        return $this->str::plural($this->nameSnakeCase($name));
    }
}
