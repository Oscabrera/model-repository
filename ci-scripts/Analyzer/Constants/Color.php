<?php

namespace Oscabrera\ModelRepository\CIScripts\Analyzer\Constants;

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
     *
     * @param string $name The name of the constant.
     * @return string The value of the constant.
     */
    public static function get(string $name): string
    {
        $color = constant("self::$name") ?? '';
        /** @var string $color */
        return $color;
    }
}
