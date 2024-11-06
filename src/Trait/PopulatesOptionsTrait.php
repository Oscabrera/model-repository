<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Trait;

use Oscabrera\ModelRepository\Classes\Options;

/**
 * Trait PopulatesOptionsTrait
 *
 * Use this trait to populate the options from the command input.
 */
trait PopulatesOptionsTrait
{
    /**
     * Get the list of options.
     *
     * @return array{
     *     hasSeeder: array<int, string>,
     *     hasMigration: array<int, string>,
     *     hasFactory: array<int, string>,
     *     hasService: array<int, string>,
     *     hasController: array<int, string>,
     *     hasRequest: array<int, string>,
     *     force: string
     * } Returns an array of options.
     */
    private function getOptionsList(): array
    {
        return [
            'hasSeeder' => ['seed', 'sd'],
            'hasMigration' => ['migration', 'm'],
            'hasFactory' => ['factory', 'f'],
            'hasService' => ['service', 's'],
            'hasController' => ['controller', 'c'],
            'hasRequest' => ['request', 'r'],
            'force' => 'force',
        ];
    }

    /**
     * Initializes the option values with false for each option in the provided options list.
     *
     * @param array{
     *      hasSeeder: array<int, string>,
     *      hasMigration: array<int, string>,
     *      hasFactory: array<int, string>,
     *      hasService: array<int, string>,
     *      hasController: array<int, string>,
     *      hasRequest: array<int, string>,
     *      force: string
     *  } $optionsList The list of options.
     *
     * @return array<string, bool> The initialized option values.
     */
    private function initializeOptionValues(array $optionsList): array
    {
        $optionValues = [];
        $options = array_keys($optionsList);
        foreach ($options as $option) {
            $optionValues[$option] = false;
        }
        return $optionValues;
    }

    /**
     * Create a new Options object based on the given option values.
     *
     * @param array<string, bool> $optionValues An associative array containing the option values.
     */
    private function createOptionsObject(array $optionValues): Options
    {
        return new Options(
            $optionValues['hasSeeder'],
            $optionValues['hasMigration'],
            $optionValues['hasFactory'],
            $optionValues['hasService'],
            $optionValues['hasController'],
            $optionValues['hasRequest'],
            $optionValues['force']
        );
    }

    /**
     * Checks if the "all" option is set and returns its boolean value.
     */
    private function shouldForceAll(): bool
    {
        return $this->hasOption('all') && boolval($this->option('all'));
    }
}
