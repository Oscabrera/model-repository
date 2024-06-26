<?php

namespace Oscabrera\ModelRepository\CIScripts;

require_once __DIR__ . '/PhpMDAnalyzer.php';

use Oscabrera\ModelRepository\CIScripts\phpMD\PhpMDAnalyzer as Analyzer;

/**
 * Analyze with PHP Mess Detector
 */
$args = array_slice($_SERVER['argv'], 1); // Get arguments passed to the script
exit((new Analyzer($args))->analyze() ? 0 : 1);
