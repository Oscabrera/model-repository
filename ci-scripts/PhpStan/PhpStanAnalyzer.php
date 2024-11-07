<?php

declare(strict_types=1);

namespace Oscabrera\AnalyzerTool\CIScripts\PhpStan;

use Oscabrera\AnalyzerTool\CIScripts\Analyzer\Analyzer;

class PhpStanAnalyzer extends Analyzer
{
    /**
     * @param array<int, string> $args
     * Constructor for the class, command is for validated in the PhpStan.
     */
    public function __construct(array $args)
    {
        parent::__construct(
            'PHPStan',
            <<<CMD
            ./vendor/bin/phpstan analyse --memory-limit=1G -c ci-scripts/PhpStan/phpstan.neon --ansi %FILES%
            CMD,
            $args,
        );
    }
}
