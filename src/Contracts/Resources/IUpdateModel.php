<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Contracts\Resources;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface IEntityUpdate
 *
 * Defines the contract for updating a record in the database.
 */
interface IUpdateModel
{
    /**
     * Updates the given record in the database.
     *
     * @param array<string, mixed> $dataEntity
     */
    public function update(Model $entity, array $dataEntity): bool;
}
