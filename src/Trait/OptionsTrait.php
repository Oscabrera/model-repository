<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Trait;

/**
 * Trait PopulatesOptionsTrait
 *
 * Use this trait to populate the options from the command input.
 */
trait OptionsTrait
{
    /**
     * Evaluate the option value based on command option
     *
     * @param array<int, string>|string $commandOption The command option to be evaluated
     */
    private function evaluateOption(array|string $commandOption): bool
    {
        if (is_array($commandOption)) {
            foreach ($commandOption as $value) {
                if ($this->hasOption($value)) {
                    return boolval($this->option($value));
                }
            }
            return false;
        }
        return $this->hasOption($commandOption) && boolval($this->option($commandOption));
    }
}
