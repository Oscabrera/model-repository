<?php

declare(strict_types=1);

namespace Oscabrera\AnalyzerTool\CIScripts\Analyzer;

use RuntimeException;

class FileHandler
{
    public function __construct(
        protected string $extension,
        protected string $branch,
    ) {}

    /**
     * Get the modified files git log.
     *
     * @return string The modified files git log.
     */
    public function getModifiedFilesGit(): string
    {
        $gitLog = $this->getGitLog();
        $gitLogLines = array_filter(explode("\n", $gitLog));
        return $this->sanitizeFiles($gitLogLines);
    }

    /**
     * Get the modified files git log.
     */
    public function getModifiedFilesComa(string $files): string
    {
        $fileLines = array_filter(explode(',', $files));
        return $this->sanitizeFiles($fileLines);
    }

    /**
     * Returns an array of escaped shell arguments corresponding to
     *  modified files in the git log.
     *
     * @param array<int, string> $gitLogLines
     */
    public function sanitizeFiles(array $gitLogLines): string
    {
        $escapedFiles = array_map(
            'escapeshellarg',
            array_filter($gitLogLines, function ($line) {
                return $this->isValidFile($line);
            }),
        );
        return implode(' ', $escapedFiles);
    }

    /**
     * Check if the file is valid for analysis.
     */
    protected function isValidFile(string $line): bool
    {
        return str_ends_with($line, ".{$this->extension}") && is_file($line);
    }

    /**
     * Get the git log.
     */
    private function getGitLog(): string
    {
        $gitLog = shell_exec("git diff --name-only {$this->branch} 2>&1");
        if ($gitLog === null || $gitLog === false) {
            throw new RuntimeException('git log command failed');
        }
        return trim($gitLog);
    }
}
