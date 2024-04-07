# QueryOptions Structure

## Constructor

```php
public function __construct(
    array $conditions = [],
    array $columns = ['*']
)
```

The constructor for the QueryOptions class takes two optional arguments:

conditions: An associative array that defines the filtering conditions for the query. (optional, defaults to [])
columns: An array of strings representing the columns to select in the query. (optional, defaults to ['*'])

## Methods

### Public Methods

**conditionQuery** (Builder $query): This method applies the conditions defined in the conditions property to the query
builder object.

### Protected Methods

**handleArrayCondition** (Builder $query, string|int $key, array $condition): This internal method handles filtering
conditions that are arrays. It analyzes the format of the array and applies the appropriate condition to the query
builder object.

**handleTripleCondition** (Builder $query, array $condition): This internal method handles filtering conditions that are
arrays with three elements. The first element represents the column, the second the comparison operator, and the third
the value(s) to be compared.

**handleArrayValueCondition** (Builder $query, array $condition): This internal method handles filtering conditions
where the value is an array. It applies the whereIn or whereNotIn condition depending on the operator used.

**handleSubQueryCondition** (Builder $query, string $column, Closure $subQuery): This internal method handles filtering
conditions that use subqueries. The subquery is defined by a closure that is executed to construct the secondary query.

**handleSubQueryConditionNot** (Builder $query, string $column, Closure $subQuery): This internal method is similar to
handleSubQueryCondition but is used for conditions with the NOT IN operator.

