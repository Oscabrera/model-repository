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
     *
     * @param QueryFilters $options
     * An associative array of conditions to match the record against.
     *
     * @return Model The fetched record if found.
     */
    public function search(QueryFilters $options): Model;
}
```