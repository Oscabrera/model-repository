<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Handlers;

use Oscabrera\ModelRepository\Trait\ArrayHandlerBindingTrait;

class BindingServices
{
    use ArrayHandlerBindingTrait;

    /**
     * Update the configuration file with new bindings.
     */
    public function updateConfigFile(string $name, string $interfaceClass, string $serviceClass): void
    {
        $configPath = $this->getConfigPath();
        $config = $this->getConfigFile($configPath);
        $newBindings = $this->defineBindings($name, $interfaceClass, $serviceClass);
        $configContent = $this->formatConfigFile($config, $newBindings);
        $this->saveConfigFile($configPath, $configContent);
    }

    /**
     * Retrieves the configuration path for the binding provider.
     *
     * @return string The path to the `binding-provider.php` configuration file.
     */
    private function getConfigPath(): string
    {
        return config_path('binding-provider.php');
    }

    /**
     * Retrieves and processes the configuration file from the specified path.
     *
     * @param string $configPath The path to the configuration file.
     *
     * @return array{
     *      interfaces?: array<string,
     *      array{interface: string, implementation: string}
     *     }
     *  The configuration file content.
     */
    private function getConfigFile(string $configPath): array
    {
        $config = file_exists($configPath) ? require $configPath : [];
        $config['interfaces'] = isset($config['interfaces']) && is_array(
            $config['interfaces']
        ) ? $config['interfaces'] : [];

        return $config;
    }

    /**
     * Defines the bindings for a given service by mapping the interface to its implementation.
     *
     * @param string $name The name identifier for the service binding.
     * @param string $interfaceClass The fully qualified name of the interface class.
     * @param string $serviceClass The fully qualified name of the service class implementing the interface.
     *
     * @return array Returns an associative array with the service name as the key and its binding configuration as the value.
     */
    private function defineBindings(string $name, string $interfaceClass, string $serviceClass): array
    {
        return [
            $name => [
                'interface' => $interfaceClass,
                'implementation' => $serviceClass,
            ],
        ];
    }

    /**
     * Save the configuration content to the specified file path.
     *
     * @param string $configPath The path to the configuration file.
     * @param string $configContent The content to write into the configuration file.
     *
     * @return void
     */
    private function saveConfigFile(string $configPath, string $configContent): void
    {
        file_put_contents($configPath, $configContent);
    }
}
