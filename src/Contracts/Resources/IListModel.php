<?php

namespace Oscabrera\ModelRepository\Contracts\Resources;

use Illuminate\Pagination\LengthAwarePaginator;
use Oscabrera\QueryFilters\Utilities\QueryFilters;

/**
 * Interface IEntityList
 *
 * Defines the contract for classes that implement list functionality for entities.
 */
interface IListModel
{
    /**
     * Lists records from the database based on the given conditions.
     *
     * @param QueryFilters $options
     *
     * @return LengthAwarePaginator An array of records that match the conditions.
     */
    public function list(QueryFilters $options): LengthAwarePaginator;
}
