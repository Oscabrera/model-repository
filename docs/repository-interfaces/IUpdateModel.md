# IUpdateModel

The `IUpdateModel` interface defines the methods necessary for updating models.

## Code
```php
<?php

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
     * @param Model $entity The record to be updated.
     * @param array<string, mixed> $dataEntity
     *
     * @return bool True if the record was successfully updated, false otherwise.
     */
    public function update(Model $entity, array $dataEntity): bool;
}
```