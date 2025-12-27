<?php

namespace Oscabrera\ModelRepository\DevTools;

use Illuminate\Foundation\Http\FormRequest;
use InvalidArgumentException;
use Oscabrera\ModelRepository\Trait\ArrayHandlerBindingTrait;
use Oscabrera\ModelRepository\Trait\FailedValidationTrait;
use Oscabrera\ModelRepository\Trait\OptionsTrait;
use Oscabrera\ModelRepository\Trait\PopulatesOptionsTrait;
use ReflectionClass;
use ReflectionException;
use RuntimeException;

class ClassAccessUtils
{
    /**
     * Returns an anonymous class instance that uses the PopulatesOptionsTrait
     *
     * @return object The anonymous class instance
     */
    public function getClassUsingTrait(string $traitName): object
    {
        return match ($traitName) {
            'PopulatesOptionsTrait' => $this->getPopulatesOptionsTrait(),
            'OptionsTrait' => $this->getOptionsTrait(),
            'FailedValidationTrait' => $this->getFailedValidationTrait(),
            'ArrayHandlerBindingTrait' => $this->getArrayHandlerBindingTrait(),
            default => throw new InvalidArgumentException("Trait {$traitName} not found."),
        };
    }

    /**
     * Sets a method as accessible using ReflectionClass
     * @param object $instance The class using the trait
     * @param string $methodName The name of the method
     * @param array<int, mixed> $arguments The arguments of the method
     * her use mixed to allow any type
     *
     * @return mixed use mixed to allow any type
     *
     * @throws RuntimeException If an error occurs while setting the method as accessible
     */
    public static function callPrivateMethod(object $instance, string $methodName, array $arguments = []): mixed
    {
        try {
            $reflection = new ReflectionClass($instance);
            $method = $reflection->getMethod($methodName);
            $method->setAccessible(true);

            return $method->invokeArgs($instance, $arguments);
        } catch (ReflectionException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    /**
     * This function returns an object that uses the `PopulatesOptionsTrait`.
     *
     * @return object An object with the `PopulatesOptionsTrait`.
     */
    private function getPopulatesOptionsTrait(): object
    {
        return new class {
            use PopulatesOptionsTrait;

            /** @var array<string, bool>  */
            private array $options = [];

            public function hasOption(string $option): bool
            {
                return isset($this->options[$option]);
            }

            public function option(string $option): ?bool
            {
                return $this->options[$option] ?? null;
            }

            /**
             * @param array<string, bool> $options
             */
            public function setOptions(array $options): void
            {
                $this->options = $options;
            }
        };
    }

    /**
     * This function returns an object that uses the `PopulatesOptionsTrait`.
     *
     * @return object An object with the `PopulatesOptionsTrait`.
     */
    private function getOptionsTrait(): object
    {
        return new class {
            use OptionsTrait;

            /** @var array<string, bool>  */
            private array $options = [];

            public function hasOption(string $option): bool
            {
                return isset($this->options[$option]);
            }

            public function option(string $option): ?bool
            {
                return $this->options[$option] ?? null;
            }

            /**
             * @param array<string, bool> $options
             */
            public function setOptions(array $options): void
            {
                $this->options = $options;
            }
        };
    }

    private function getFailedValidationTrait(): object
    {
        return new class extends FormRequest {
            use FailedValidationTrait;

            public function authorize(): bool
            {
                return true;
            }

            /**
             * @return array<string, string>
             */
            public function rules(): array
            {
                return [];
            }
        };
    }

    private function getArrayHandlerBindingTrait(): object
    {
        return new class {
            use ArrayHandlerBindingTrait;
        };
    }
}
