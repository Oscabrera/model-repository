<?php

declare(strict_types=1);

namespace Oscabrera\AnalyzerTool\CIScripts\Analyzer\Constants;

class Color
{
    /** Colors constants */
    public const RED = "\033[31m";
    public const BLUE = "\033[34m";
    public const YELLOW = "\033[33m";
    public const GREEN = "\033[32m";
    public const END = "\033[0m";

    /**
     * Get the value of a constant with the given name.
     */
    public static function get(string $name): string
    {
        $constantName = "self::{$name}";

        if (defined($constantName)) {
            $value = constant($constantName);
            if (is_string($value)) {
                return $value;
            }
        }

        return '';
    }
}
