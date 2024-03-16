<?php

namespace Oscabrera\ModelRepository\Handlers;

use Oscabrera\ModelRepository\Exception\CreateStructureException;
use Oscabrera\ModelRepository\Exception\StubException;
use Illuminate\Support\Facades\File;

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
        protected File $file
    ) {
    }

    /**
     * Creates a class from a stub.
     *
     * @param string $classPath
     * @param array<string, string> $replacements
     * @param string $type
     * @return array{type: string, path: string}
     * @throws StubException|CreateStructureException
     */
    protected function createFromClassStub(
        string $classPath,
        array $replacements,
        string $type
    ): array {
        if ($this->file::exists($classPath)) {
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
        return strval(realpath(__DIR__ . '/../../stubs/' . $type . '.stub'));
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
}
