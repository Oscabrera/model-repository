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
        $configPath = config_path('binding-provider.php');
        $config = file_exists($configPath) ? require $configPath : [];
        $config['interfaces'] = isset($config['interfaces']) && is_array(
            $config['interfaces']
        ) ? $config['interfaces'] : [];

        $newBindings = [
            $name => [
                'interface' => $interfaceClass,
                'implementation' => $serviceClass,
            ],
        ];
        $configContent = $this->formatConfigFile($config, $newBindings);

        file_put_contents($configPath, $configContent);
    }
}
