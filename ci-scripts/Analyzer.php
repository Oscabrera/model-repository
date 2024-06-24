<?php

namespace Oscabrera\ModelRepository\CIScripts;

use Exception;
use RuntimeException;

/**
 * Analyze with PHPStan only modified files
 */
class Analyzer
{
    /**
     * Define the branch to analyze
     *
     * @var string
     */
    public const BRANCH = 'origin/develop';

    /**
     * @var array<int, string>
     */
    protected array $args;

    /** Colors constants */
    public const RED_COLOR = "\033[31m";
    public const BLUE_COLOR = "\033[34m";
    public const YELLOW_COLOR = "\033[33m";
    public const END_COLOR = "\033[0m";
    /** Constants for icons */
    public const NO_FILES_ICON = "\u{1F4ED}"; // 📭
    public const SUCCESS_ICON = "\u{2705}"; // ✅
    public const CRITICAL_ERROR_ICON = "\u{1F6A8}"; // 🚨
    public const EXCEPTION_ICON = "\u{1F525}"; // 🔥
    public const STACK_TRACE_ICON = "\u{1F6E0}"; // 🛠

    /**
     * @var string
     */
    protected string $command;

    /**
     * Constructor for the class
     *
     * @param string $command The command string
     */
    public function __construct(string $command)
    {
        $this->command = $command;
    }

    /**
     * Analyze with PHPStan only modified files
     *
     * @return bool Returns an exit status code. 0 indicates success (OK),
     *             and any other number indicates an error.
     */
    public function analyze(): bool
    {
        try {
            $modifiedFiles = $this->getFiles();
            if (empty($modifiedFiles)) {
                $this->echoColor('No PHP files modified', self::BLUE_COLOR, self::NO_FILES_ICON);
                return true;
            }
            if (!$this->executePhpStan($modifiedFiles)) {
                $this->echoColor('PHPStan analysis failed', self::RED_COLOR, self::CRITICAL_ERROR_ICON);
                return false;
            }

            $this->echoColor('PHPStan analysis succeeded', self::BLUE_COLOR, self::SUCCESS_ICON);
            return true;
        } catch (RuntimeException|Exception $e) {
            $this->echoColor($e->getMessage(), self::RED_COLOR, self::EXCEPTION_ICON);
            return false;
        }
    }

    /**
     * Get files to analyze with PHPStan
     *
     * @return string Returns a string representation of the files to analyze.
     * @throws Exception
     */
    private function getFiles(): string
    {
        $allFlag = in_array('--all', $this->args, true);
        if ($allFlag) {
            $this->echoColor('Executing analysis on .', self::YELLOW_COLOR, self::STACK_TRACE_ICON);
            return '.';
        }
        $dir = $this->getDirFlag();
        return $dir ?? $this->getDiffBranch();
    }

    /**
     * Get the directory flag value from the command line arguments
     *
     * @return string|null Returns the directory flag value if found, null otherwise
     */
    private function getDirFlag(): ?string
    {
        foreach ($this->args as $arg) {
            if (str_starts_with($arg, '--dir=')) {
                $file = substr($arg, strlen('--dir='));
                $this->echoColor('Executing analysis on ' . $file, self::YELLOW_COLOR, self::STACK_TRACE_ICON);
                return $file;
            }
        }
        return null;
    }

    /**
     * Returns an array of modified files in the git log.
     *
     * @return string An array of modified files
     * @throws Exception
     */
    private function getDiffBranch(): string
    {
        $gitLog = shell_exec('git diff --name-only ' . self::BRANCH . ' 2>&1');
        if ($gitLog === null) {
            throw new RuntimeException('git log command failed');
        }

        return $this->getPHPModifiedFiles(!$gitLog ? '' : $gitLog);
    }

    /**
     * Returns an array of escaped shell arguments corresponding to modified PHP files in the git log.
     *
     * @param string $gitLog The git log containing a list of modified files
     * @return string
     */
    private function getPHPModifiedFiles(string $gitLog): string
    {
        $gitLogLines = array_filter(explode("\n", trim($gitLog)));
        $escapedFiles = [];
        foreach ($gitLogLines as $line) {
            if (str_ends_with($line, '.php') && is_file($line)) {
                $escapedFiles[] = escapeshellarg($line);
            }
        }
        if (empty($escapedFiles)) {
            return '';
        }

        return implode(' ', $escapedFiles);
    }

    /**
     * Echoes a colored message to the console.
     *
     * @param string $message The message to be echoed
     * @param string $color The color to be applied to the message
     * @param string $icon
     * @return void
     */
    private function echoColor(string $message, string $color, string $icon = ''): void
    {
        echo "\n";
        echo $icon . $color . '  ' . $message . self::END_COLOR;
        echo "\n";
        echo "\n";
    }

    /**
     * Executes PHPStan analysis on the modified PHP files.
     *
     * @param string $modifiedFiles The list of modified PHP files passed as shell arguments
     * @return bool Returns true if the analysis returns non-zero exit code, false otherwise
     */
    private function executePhpStan(string $modifiedFiles): bool
    {
        $command = "{$this->command} $modifiedFiles";
        passthru($command, $return_var);
        return $return_var === 0;
    }
}
