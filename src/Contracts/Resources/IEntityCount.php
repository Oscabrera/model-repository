<?php

namespace Oscabrera\ModelRepository\Contracts\Resources;

use Oscabrera\QueryFilters\Utilities\QueryFilters;

/**
 * Interface IEntityCount
 *
 * This interface defines the contract for counting the number of records in the database that match certain conditions.
 */
interface IEntityCount
{
    /**
     * Counts the number of records in the database that match the given conditions.
     *
     * @param QueryFilters $options
     * An associative array of conditions to match the records against.
     *
     * @return int The number of records that match the conditions.
     */
    public function count(QueryFilters $options): int;
}
