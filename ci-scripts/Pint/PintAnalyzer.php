<?php

declare(strict_types=1);

namespace Oscabrera\AnalyzerTool\CIScripts\Pint;

use Oscabrera\AnalyzerTool\CIScripts\Analyzer\Analyzer;

class PintAnalyzer extends Analyzer
{
    /**
     * @param array<int, string> $args
     * Constructor for the class, command is for validated in the PhpStan.
     */
    public function __construct(array $args)
    {
        parent::__construct(
            'Pint',
            <<<CMD
            ./vendor/bin/pint --test --config ci-scripts/Pint/pint.json --ansi %FILES%
            CMD,
            $args,
        );
    }
}
