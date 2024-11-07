<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Trait;

trait ArrayHandlerBindingTrait
{
    /**
     * Format an array into a string representation.
     *
     * @param array<string, array<string, array<string, string>>|string>|array<string, string> $array
     *  The array to format.
     */
    private function formatArray(array $array, int $indentLevel = 1): string
    {
        $indent = str_repeat('    ', $indentLevel);
        $lines = $this->generateLines($array, $indentLevel, $indent);

        return implode(PHP_EOL, $lines);
    }

    /**
     * Format the configuration file content.
     *
     * @param array{
     *     interfaces: array<string,
     *      array{interface: string, implementation: string}
     *     >
     *     } $config
     *  The existing configuration array.
     * @param array<string, array{
     *     interface: string, implementation: string
     * }> $newBindings
     *  The new bindings to be added.
     */
    private function formatConfigFile(array $config, array $newBindings): string
    {
        $config['interfaces'] = array_merge(
            $config['interfaces'],
            $newBindings,
        );
        $configContent = $this->formatArray($config);
        $eol = PHP_EOL;

        return "<?php{$eol}{$eol}return [{$eol}{$configContent}{$eol}];{$eol}";
    }

    /**
     * Generate an array of formatted lines based on the input
     *
     * @param array<string, array<string, array<string, string>>|string> $array
     *
     * @return array<int, string>
     * */
    private function generateLines(array $array, int $indentLevel, string $indent): array
    {
        $lines = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                /** @var array<string, array<string, array<string, string>>|string>|array<string, string> $value */
                $lines = $this->formatNestedArrayValue(
                    $lines,
                    $value,
                    $key,
                    $indent,
                    $indentLevel,
                );
                continue;
            }
            if ($this->isInterface($key)) {
                $lines[] = $this->formatClassReference($key, $value, $indent);
                continue;
            }
            $lines[] = "{$indent}'{$key}' => '{$value}',";
        }
        return $lines;
    }

    /**
     * Format the nested array value.
     *
     * @param array<int, string> $lines The lines of the formatted array.
     * @param array<string, array<string, array<string, string>>|string>|array<string, string> $value
     * The nested array value.
     *
     * @return array<int, string> The formatted array lines.
     */
    private function formatNestedArrayValue(
        array $lines,
        array $value,
        string $key,
        string $indent,
        int $indentLevel,
    ): array {
        $lines[] = "{$indent}'{$key}' => [";
        $lines[] = $this->formatArray($value, $indentLevel + 1);
        $lines[] = "{$indent}],";
        return $lines;
    }

    /**
     * Format the class reference as a Laravel service declaration.
     */
    private function formatClassReference(string $key, string $value, string $indent): string
    {
        return "{$indent}'{$key}' => {$value}::class,";
    }

    /**
     * Check if the given key is an interface.
     */
    private function isInterface(string $key): bool
    {
        return str_contains($key, 'interface') ||
            str_contains($key, 'implementation');
    }
}
