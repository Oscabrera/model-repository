<?php

declare(strict_types=1);

namespace Oscabrera\AnalyzerTool\CIScripts\PhpMD;

use Oscabrera\AnalyzerTool\CIScripts\Analyzer\Analyzer;

class PhpMDAnalyzer extends Analyzer
{
    /**
     * @param array<int, string> $args
     * Constructor for the class, command is for validated in the
     *  PHP Mess Detector.
     */
    public function __construct(array $args)
    {
        parent::__construct(
            'PHP Mess Detector',
            <<<CMD
            ./vendor/bin/phpmd %FILES% ansi cleancode,codesize,controversial,design,unusedcode --exclude *vendors
            CMD,
            $args,
        );
    }
}
