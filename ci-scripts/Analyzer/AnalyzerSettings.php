<?php

declare(strict_types=1);

namespace Oscabrera\AnalyzerTool\CIScripts\Analyzer;

use Exception;
use Oscabrera\AnalyzerTool\CIScripts\Analyzer\Constants\Color;
use Oscabrera\AnalyzerTool\CIScripts\Analyzer\Constants\Icon;
use RuntimeException;

/**
 * Class AnalyzerSettings
 *
 * Represents the settings for an analyzer.
 */
class AnalyzerSettings
{
    protected Color $color;
    protected Icon $icon;
    protected FileHandler $fileHandler;
    protected CommandBuilder $commandBuilder;
    protected ArgumentHandler $argumentHandler;

    /**
     * Constructor.
     *
     * @param array<int, string> $args The arguments. Defaults to an empty array.
     */
    public function __construct(
        protected string $tool,
        protected string $command,
        protected array $args = [],
        protected string $extension = 'php',
        protected string $branch = 'origin/develop',
    ) {
        $this->color = new Color();
        $this->icon = new Icon();
        $this->fileHandler = new FileHandler($extension, $branch);
        $this->commandBuilder = new CommandBuilder($command, $args);
        $this->argumentHandler = new ArgumentHandler($args);
    }

    /**
     * Echoes a colored message to the console.
     */
    protected function echoColor(
        string $message,
        string $color,
        string $icon = '',
    ): void {
        echo "\n";
        echo $icon . $color . '  ' . $message . $this->color::get('END');
        echo "\n";
        echo "\n";
    }

    /**
     * Report that no files were modified to analyze
     */
    protected function reportNoFilesAnalyze(): void
    {
        $this->echoColor(
            'No files modified to analyze',
            $this->color::get('BLUE'),
            $this->icon::get('NO_FILES'),
        );
    }

    /**
     * Report that the analysis failed
     */
    protected function reportAnalysisFailed(): void
    {
        $this->echoColor(
            "{$this->tool} analysis succeeded",
            $this->color::get('BLUE'),
            $this->icon::get('SUCCESS'),
        );
    }

    /**
     * Report that the analysis succeeded
     */
    protected function reportAnalysisSucceeded(): void
    {
        $this->successMessage("{$this->tool} analysis succeeded");
    }

    /**
     * Report that the analysis succeeded
     */
    protected function successMessage(string $message, string $icon = ''): void
    {
        $this->echoColor(
            $message,
            $this->color::get('GREEN'),
            $icon === '' ? $this->icon::get('SUCCESS') : $icon,
        );
    }

    /**
     * Report that Exception was thrown
     */
    protected function reportExceptionThrown(
        RuntimeException|Exception $exception,
    ): void {
        $this->echoColor(
            $exception->getMessage(),
            $this->color::get('RED'),
            $this->icon::get('EXCEPTION'),
        );
    }

    /**
     * Report analysis execute
     */
    protected function reportAnalysisExecute(string $file): void
    {
        $this->echoColor(
            'Executing analysis on ' . $file,
            $this->color::get('YELLOW'),
            $this->icon::get('STACK_TRACE'),
        );
    }

    /**
     * Echo the analyzer all message.
     */
    protected function echoAnalyzeAll(): void
    {
        $this->echoColor(
            'Executing analysis on .',
            $this->color::get('YELLOW'),
            $this->icon::get('STACK_TRACE'),
        );
    }
}
