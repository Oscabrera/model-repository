<?php

declare(strict_types=1);

namespace Oscabrera\AnalyzerTool\CIScripts\Analyzer;

class CommandBuilder
{
    /**
     * @param array<int, string> $args The arguments. Defaults to an empty array.
     */
    public function __construct(
        protected string $command,
        protected array $args = [],
    ) {}

    /**
     * Build the command to execute.
     */
    public function buildCommand(string $modifiedFiles): string
    {
        $commandWithFiles = str_replace('%FILES%', $modifiedFiles, $this->command);
        $moreArgs = implode(' ', $this->getAdditionalArgs());

        return "{$commandWithFiles} {$moreArgs}";
    }

    /**
     * Get the arguments for the analyzer
     *
     * @return array<int, string> Returns an array of arguments to be
     *  passed to the analyzer
     */
    protected function getAdditionalArgs(): array
    {
        $toRemove = ['--all'];
        $prefixToRemove = '--dir=';

        return array_filter(
            $this->args,
            static function ($arg) use ($toRemove, $prefixToRemove) {
                return !in_array($arg, $toRemove) &&
                    !str_starts_with($arg, $prefixToRemove);
            },
        );
    }
}
