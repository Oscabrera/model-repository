<?php

namespace Oscabrera\ModelRepository\CIScripts\phpStan;

require_once __DIR__ . '/../Analyzer/Analyzer.php';

use Oscabrera\ModelRepository\CIScripts\Analyzer\Analyzer;

class PhpStanAnalyzer extends Analyzer
{
    /**
     * @param array<int, string> $args
     * Constructor for the class, command is for validated in the PhpStan.
     */
    public function __construct(array $args)
    {
        $this->setArgs($args);
        $this->setCommand('./vendor/bin/phpstan analyse --memory-limit=1G -c ci-scripts/phpStan/phpstan.neon --ansi %FILES%');
        parent::__construct();
    }
}
