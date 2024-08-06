<?php

declare(strict_types=1);

namespace Oscabrera\AnalyzerTool\CIScripts\Analyzer;

use Exception;
use RuntimeException;

/**
 * Analyze with tool only modified files
 */
class Analyzer extends AnalyzerSettings
{
    /**
     * Execute the analyzer
     *
     * Returns an exit status code. 0 indicates success (OK),
     *  and any other number indicates an error.
     */
    public function analyze(): bool
    {
        try {
            return $this->executeAnalysis();
        } catch (RuntimeException|Exception $exception) {
            $this->reportExceptionThrown($exception);
            return false;
        }
    }

    /**
     * Execute the analysis and report the result.
     *
     * @throws Exception
     */
    protected function executeAnalysis(): bool
    {
        $files = $this->getFiles();
        if ($files === '') {
            $this->reportNoFilesAnalyze();
            return true;
        }
        if (!$this->execute($files)) {
            $this->reportAnalysisFailed();
            return false;
        }
        $this->reportAnalysisSucceeded();
        return true;
    }

    /**
     * Get files to analyze
     *
     * Returns a string representation of the files to analyze.
     *
     * @throws Exception
     */
    protected function getFiles(): string
    {
        return $this->argumentHandler->shouldAnalyzeAll() ?
            $this->analyzeAllFiles() :
            $this->getDirectoryOrBranchFiles();
    }

    /**
     * Analyze all files
     *
     * This method runs the analysis process for all files.
     */
    protected function analyzeAllFiles(): string
    {
        $this->echoAnalyzeAll();
        return '.';
    }

    /**
     * Get the directory flag value from the command line arguments
     *
     * @throws Exception
     */
    protected function getDirectoryOrBranchFiles(): string
    {
        $dir = $this->argumentHandler->getDirArg();
        if ($dir === '') {
            return $this->fileHandler->getModifiedFilesGit();
        }

        return $this->extractDirFromArg($dir);
    }

    /**
     * Extract the directory from the argument.
     */
    protected function extractDirFromArg(string $dir): string
    {
        $dirFiles = $this->fileHandler->getModifiedFilesComa($dir);
        $this->reportAnalysisExecute($dirFiles);

        return $dirFiles;
    }

    /**
     * Executes analysis on the files.
     *
     * Returns true if the analysis returns non-zero exit code, false otherwise
     */
    protected function execute(string $modifiedFiles): bool
    {
        echo $this->commandBuilder->buildCommand($modifiedFiles) . PHP_EOL;

        passthru($this->commandBuilder->buildCommand($modifiedFiles), $returnVar);

        return $returnVar === 0;
    }
}
