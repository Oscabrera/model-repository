<?php

namespace Oscabrera\ModelRepository\CIScripts\Analyzer;

/**
 * Class AnalyzerSettings
 *
 * Represents the settings for an analyzer.
 */
class AnalyzerSettings
{
    /**
     * Define the branch to analyze
     *
     * @var string
     */
    protected string $branch = 'origin/develop';

    /**
     * @var array<int, string>
     */
    protected array $args;

    /**
     * @var string
     */
    protected string $extension = 'php';

    /**
     * @var string
     */
    protected string $tool = 'PHPStan';

    /**
     * @var string
     */
    protected string $command;

    /**
     * Set the branch for the application.
     *
     * @param string $branch The branch name to set.
     * @return void
     */
    public function setBranch(string $branch): void
    {
        $this->branch = $branch;
    }

    /**
     * Sets the arguments.
     *
     * @param array<int, string> $args The array of arguments.
     * @return void
     */
    public function setArgs(array $args): void
    {
        $this->args = $args;
    }

    /**
     * Set the extension for the given file.
     *
     * @param string $extension The extension to be set.
     * @return void
     */
    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    /**
     * Set the tool for the application.
     *
     * @param string $tool The tool to set.
     * @return void
     */
    public function setTool(string $tool): void
    {
        $this->tool = $tool;
    }

    /**
     * Set the command.
     *
     * @param string $command The command to set.
     * @return void
     */
    public function setCommand(string $command): void
    {
        $this->command = $command;
    }
}
