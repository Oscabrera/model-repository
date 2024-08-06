<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Contracts\Resources;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface IEntityCreate
 *
 * This interface defines the contract for creating a
 *  new record in the database.
 */
interface ICreateModel
{
    /**
     * Create a new record in the database.
     *
     * @param array<string, mixed> $entity The object to be created.
     */
    public function create(array $entity): Model;
}
