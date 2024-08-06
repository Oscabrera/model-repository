<?php

declare(strict_types=1);

namespace Oscabrera\AnalyzerTool\CIScripts\Analyzer\Constants;

class Icon
{
    /** Constants for icons */
    public const NO_FILES = "\u{1F4ED}"; // 📭
    public const SUCCESS = "\u{2705}"; // ✅
    public const CRITICAL_ERROR = "\u{1F6A8}"; // 🚨
    public const EXCEPTION = "\u{1F525}"; // 🔥
    public const STACK_TRACE = "\u{1F6E0}"; // 🛠
    public const COMMAND = "\u{1F4DD}"; // 📝

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
