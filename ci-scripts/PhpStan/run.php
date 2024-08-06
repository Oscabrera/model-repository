<?php

declare(strict_types=1);

namespace Oscabrera\AnalyzerTool\CIScripts;

require_once __DIR__ . '/../../vendor/autoload.php';

use Oscabrera\AnalyzerTool\CIScripts\PhpStan\PhpStanAnalyzer as Analyzer;

exit((new Analyzer(array_slice($_SERVER['argv'], 1)))->analyze() ? 0 : 1);
