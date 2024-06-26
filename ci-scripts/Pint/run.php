<?php

namespace Oscabrera\ModelRepository\CIScripts;

require_once __DIR__ . '/PintAnalyzer.php';

use Oscabrera\ModelRepository\CIScripts\Pint\PintAnalyzer as Analyzer;

/**
 * Analyze with PHPStan
 */
exit((new Analyzer(array_slice($_SERVER['argv'], 1)))->analyze() ? 0 : 1);
