<?php

namespace Oscabrera\ModelRepository\CIScripts\Analyzer\Constants;

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
     *
     * @param string $name The name of the constant.
     * @return string The value of the constant.
     */
    public static function get(string $name): string
    {
        $icon = constant("self::$name") ?? '';
        /** @var string $icon */
        return $icon;
    }
}
