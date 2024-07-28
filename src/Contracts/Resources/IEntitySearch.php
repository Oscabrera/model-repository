<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Contracts\Resources;

use Illuminate\Database\Eloquent\Model;
use Oscabrera\QueryFilters\Utilities\QueryFilters;

/**
 * Interface IEntitySearch
 *
 * Defines a contract for searching entities in a database.
 */
interface IEntitySearch
{
    /**
     * Finds a single record from the database that matches the
     *  given conditions.
     */
    public function search(QueryFilters $options): Model;
}
