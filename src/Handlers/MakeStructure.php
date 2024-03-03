<?php

namespace Oscabrera\ModelRepository\Handlers;

use Oscabrera\ModelRepository\Exception\StubException;
use Illuminate\Support\Facades\File;

class MakeStructure
{
    /**
     * Creates a class from a stub.
     *
     * @param string $stubPath
     * @param string $classPath
     * @param array $replacements
     * @param string $type
     * @return string
     * @throws StubException
     */
    protected function createFromClassStub(
        string $stubPath,
        string $classPath,
        array $replacements,
        string $type
    ): string {
        if (!file_exists($stubPath)) {
            throw new StubException($type . ' stub not found.');
        }
        $classContent = str_replace(
            array_keys($replacements),
            array_values($replacements),
            file_get_contents($stubPath)
        );
        file_put_contents($classPath, $classContent);
        return $type . ' created successfully.';
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
        return __DIR__ . '/stubs/' . $type . '.stub';
    }

    /**
     * Retrieves the content of a stub file based on the given type.
     *
     * @param string $type The type of the stub.
     *
     * @return string The content of the stub file.
     */
    protected function getStubContent(string $type): string
    {
        return file_get_contents($this->getStubPath($type));
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
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true, true);
        }
        return $directory . "/{$name}{$type}.php";
    }
}
