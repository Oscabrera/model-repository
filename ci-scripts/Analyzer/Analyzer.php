<?php

namespace Oscabrera\ModelRepository\CIScripts\Analyzer;

require_once __DIR__ . '/AnalyzerSettings.php';
require_once __DIR__ . '/Constants/Color.php';
require_once __DIR__ . '/Constants/Icon.php';

use Exception;
use Oscabrera\ModelRepository\CIScripts\Analyzer\Constants\Color;
use Oscabrera\ModelRepository\CIScripts\Analyzer\Constants\Icon;
use RuntimeException;

/**
 * Analyze with tool only modified files
 */
class Analyzer extends AnalyzerSettings
{
    /**
     * @var Color
     */
    protected Color $color;

    /**
     * @var Icon
     */
    protected Icon $icon;

    /**
     * Constructor for the class
     *
     */
    public function __construct()
    {
        $this->color = new Color();
        $this->icon = new Icon();
    }

    /**
     * Execute the analyzer
     *
     * @return bool Returns an exit status code. 0 indicates success (OK),
     *             and any other number indicates an error.
     */
    public function analyze(): bool
    {
        try {
            $modifiedFiles = $this->getFiles();
            if (empty($modifiedFiles)) {
                $this->echoColor(
                    'No files modified to analyze',
                    $this->color::get('BLUE'),
                    $this->icon::get('NO_FILES')
                );
                return true;
            }
            if (!$this->execute($modifiedFiles)) {
                $this->echoColor(
                    "$this->tool analysis failed",
                    $this->color::get('RED'),
                    $this->icon::get('CRITICAL_ERROR')
                );
                return false;
            }

            $this->echoColor(
                "$this->tool analysis succeeded",
                $this->color::get('BLUE'),
                $this->icon::get('SUCCESS')
            );
            return true;
        } catch (RuntimeException|Exception $e) {
            $this->echoColor($e->getMessage(), $this->color::get('RED'), $this->icon::get('EXCEPTION'));
            return false;
        }
    }

    /**
     * Get files to analyze
     *
     * @return string Returns a string representation of the files to analyze.
     * @throws Exception
     */
    private function getFiles(): string
    {
        $allFlag = in_array('--all', $this->args, true);
        if ($allFlag) {
            $this->echoColor('Executing analysis on .', $this->color::get('YELLOW'), $this->icon::get('STACK_TRACE'));
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
                $this->echoColor(
                    'Executing analysis on ' . $file,
                    $this->color::get('YELLOW'),
                    $this->icon::get('STACK_TRACE')
                );
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
        $gitLog = shell_exec("git diff --name-only $this->branch 2>&1");
        if ($gitLog === null) {
            throw new RuntimeException('git log command failed');
        }

        return $this->getModifiedFiles(!$gitLog ? '' : $gitLog);
    }

    /**
     * Returns an array of escaped shell arguments corresponding to modified files in the git log.
     *
     * @param string $gitLog The git log containing a list of modified files
     * @return string
     */
    private function getModifiedFiles(string $gitLog): string
    {
        $gitLogLines = array_filter(explode("\n", trim($gitLog)));
        $escapedFiles = [];
        foreach ($gitLogLines as $line) {
            if (str_ends_with($line, ".$this->extension") && is_file($line)) {
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
        echo $icon . $color . '  ' . $message . $this->color::get('END');
        echo "\n";
        echo "\n";
    }

    /**
     * Executes analysis on the files.
     *
     * @param string $modifiedFiles The list of modified files passed as shell arguments
     * @return bool Returns true if the analysis returns non-zero exit code, false otherwise
     */
    private function execute(string $modifiedFiles): bool
    {
        $additionalArgs = $this->getAdditionalArgs();
        $this->echoColor(
            "$this->command $modifiedFiles " . implode(' ', $additionalArgs),
            $this->color::get('GREEN'),
            $this->icon::get('COMMAND')
        );
        $command = "$this->command $modifiedFiles " . implode(' ', $additionalArgs);
        passthru($command, $return_var);
        return $return_var === 0;
    }

    /**
     * Get the arguments for the analyzer
     *
     * @return array<int, string> Returns an array of arguments to be passed to the analyzer
     */
    private function getAdditionalArgs(): array
    {
        $toRemove = ['--all'];
        $prefixToRemove = '--dir=';

        return array_filter(
            $this->args,
            static function ($arg) use ($toRemove, $prefixToRemove) {
                return !in_array($arg, $toRemove) && !str_starts_with($arg, $prefixToRemove);
            }
        );
    }
}
