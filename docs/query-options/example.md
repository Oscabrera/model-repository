# Usage Example

```php
$conditions = [
            'rate' => [
                'subQuery' => function ($query) use (array $excluded) {
                    $subQuery = $query->from('reviews as a')->selectRaw('min(a.rate)')->where('a.active', true);
                    if($excluded) {
                        $subQuery->whereNotIn('a.name', $excluded);
                    }
                    return $subQuery;
                },
                'not' => false,
            ],
            ['name', '<>', $excluded],
            'active' => true
        ];

$options = new QueryOptions($conditions);

$query = User::query();
$options->conditionQuery($query);
$users = $query->get();
```

This example defines a `$conditions` array with various filtering conditions. Then, an instance of the `QueryOptions` class
is created and applied to the query builder object using the `conditionQuery` method. Finally, the query is executed to
retrieve the users that meet the specified conditions.