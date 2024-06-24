<?php

namespace Oscabrera\ModelRepository\CIScripts\phpStan;

require_once __DIR__ . '/../Analyzer.php';

use Oscabrera\ModelRepository\CIScripts\Analyzer;

class PhpStanAnalyzer extends Analyzer
{
    /**
     * @param array<int, string> $args
     * Constructor for the class, command is for validated in the PhpStan.
     */
    public function __construct(array $args)
    {
        $this->args = $args;
        parent::__construct(
            './vendor/bin/phpstan analyse --memory-limit=1G -c ci-scripts/phpStan/phpstan.neon --ansi'
        );
    }
}