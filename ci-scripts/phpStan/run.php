<?php

namespace Oscabrera\ModelRepository\CIScripts;

require_once __DIR__ . '/PhpStanAnalyzer.php';

use Oscabrera\ModelRepository\CIScripts\phpStan\PhpStanAnalyzer;

/**
 * Analyze with PHPStan
 */
$args = array_slice($_SERVER['argv'], 1); // Get arguments passed to the script
exit((new PhpStanAnalyzer($args))->analyze() ? 0 : 1);
