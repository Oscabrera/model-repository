<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Contracts\Resources;

use Oscabrera\QueryFilters\Utilities\QueryFilters;

/**
 * Interface IEntityCount
 *
 * This interface defines the contract for counting the number of
 *  records in the database that match certain conditions.
 */
interface IEntityCount
{
    /**
     * Counts the number of records in the database that match
     *  the given conditions.
     */
    public function count(QueryFilters $options): int;
}
