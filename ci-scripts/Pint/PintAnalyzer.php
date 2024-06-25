<?php

namespace Oscabrera\ModelRepository\CIScripts\Pint;

require_once __DIR__ . '/../Analyzer/Analyzer.php';

use Oscabrera\ModelRepository\CIScripts\Analyzer\Analyzer;

class PintAnalyzer extends Analyzer
{
    /**
     * @param array<int, string> $args
     * Constructor for the class, command is for validated in the PhpStan.
     */
    public function __construct(array $args)
    {
        $this->setArgs($args);
        $this->setTool('Pint');
        $this->setCommand('./vendor/bin/pint --test --config ci-scripts/Pint/pint.json --ansi');
        parent::__construct();
    }
}
