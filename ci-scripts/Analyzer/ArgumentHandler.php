<?php

declare(strict_types=1);

namespace Oscabrera\AnalyzerTool\CIScripts\Analyzer;

class ArgumentHandler
{
    /**
     * @param array<int, string> $args The arguments. Defaults to an empty array.
     */
    public function __construct(
        protected array $args,
    ) {}

    /**
     * Check if it should analyze all files.
     */
    public function shouldAnalyzeAll(): bool
    {
        return in_array('--all', $this->args, true);
    }

    /**
     * Get the directory argument from the list of arguments.
     */
    public function getDirArg(): string
    {
        foreach ($this->args as $arg) {
            if (str_starts_with($arg, '--dir=')) {
                return $this->extractDirFromArg($arg);
            }
        }
        return '';
    }

    /**
     * Extract the directory from the argument.
     */
    private function extractDirFromArg(string $arg): string
    {
        return substr($arg, strlen('--dir='));
    }
}
