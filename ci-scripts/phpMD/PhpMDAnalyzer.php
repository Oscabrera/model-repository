<?php

namespace Oscabrera\ModelRepository\CIScripts\phpMD;

require_once __DIR__ . '/../Analyzer/Analyzer.php';

use Oscabrera\ModelRepository\CIScripts\Analyzer\Analyzer;

class PhpMDAnalyzer extends Analyzer
{
    /**
     * @param array<int, string> $args
     * Constructor for the class, command is for validated in the PHP Mess Detector.
     */
    public function __construct(array $args)
    {
        $this->setArgs($args);
        $this->setTool('PHP Mess Detector');
        $this->setCommand('./vendor/bin/phpmd %FILES% ansi cleancode,codesize,controversial,design,unusedcode --exclude *vendor');
        parent::__construct();
    }
}
