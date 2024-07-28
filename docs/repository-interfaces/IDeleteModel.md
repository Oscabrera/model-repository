# IDeleteModel

The `IDeleteModel` interface defines the methods necessary for deleting models.

## Code
```php
<?php

namespace Oscabrera\ModelRepository\Contracts\Resources;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface IEntityDelete
 *
 * Defines the methods that a service class must implement to perform delete operations on entities.
 */
interface IDeleteModel
{
    /**
     * Deletes a record from the database based on the given ID.
     */
    public function delete(Model $entity): bool;
}
```