# IEntitySearch

This interface defines the contract for searching entities in a database, use QueryFilters to filter records.

## Code

```php
<?php

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
     * Finds a single record from the database that matches the given conditions.
     */
    public function search(QueryFilters $options): Model;
}
```