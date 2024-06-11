<?php

namespace Oscabrera\ModelRepository\Handlers;

class BindingServices
{
    /**
     * Update the configuration file with new bindings.
     *
     * @param string $name The name of the binding.
     * @param string $interfaceClass The interface class name.
     * @param string $serviceClass The service class name.
     * @return void
     */
    public function updateConfigFile(string $name, string $interfaceClass, string $serviceClass): void
    {
        $configPath = config_path('binding-provider.php');
        $config['interfaces'] = [];
        if(file_exists($configPath)) {
            $config = require $configPath;
        }

        $newBindings = [
            $name =>
                [
                    'interface' => $interfaceClass,
                    'implementation' => $serviceClass,
                ]
        ];
        $configContent = $this->formatConfigFile($config, $newBindings);

        file_put_contents($configPath, $configContent);
    }

    /**
     * Format the configuration file content.
     *
     * @param array{interfaces: array<string, array{interface: string, implementation: string}>} $config The existing configuration array.
     * @param array<string, array{interface: string, implementation: string}> $newBindings The new bindings to be added.
     * @return string The formatted configuration file content.
     */
    private function formatConfigFile(array $config, array $newBindings): string
    {
        $config['interfaces'] = array_merge($config['interfaces'], $newBindings);

        return '<?php' . PHP_EOL . PHP_EOL . 'return [' . PHP_EOL . $this->formatArray($config) . PHP_EOL . '];' . PHP_EOL;
    }

    /**
     * Format an array into a string representation.
     *
     * @param array<string, mixed> $array The array to format.
     * @param int $indentLevel The level of indentation to use.
     * @return string The formatted array as a string.
     */
    public function formatArray(array $array, int $indentLevel = 1): string
    {
        $indent = str_repeat('    ', $indentLevel);
        $lines = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $lines[] = $indent . "'" . $key . "' => [";
                $lines[] = $this->formatArray($value, $indentLevel + 1);
                $lines[] = $indent . "],";
                continue;
            }
            if (str_contains($key, 'interface') || str_contains($key, 'implementation')) {
                $lines[] = $indent . "'" . $key . "' => " . $value . '::class,';
                continue;
            }

            $lines[] = $indent . "'" . $key . "' => '" . $value . "',";
        }

        return implode(PHP_EOL, $lines);
    }
}
