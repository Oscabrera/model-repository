# QueryOptions Class

The QueryOptions class in the `Oscabrera\ModelRepository\Utilities` namespace provides a way to specify query options
for performing database queries in Laravel. This class allows you to define the columns to select, the filtering
conditions, whether DISTINCT clauses should be applied and how to sort the results.

## Properties

- **columns** (array<int, string>): Stores a list of columns to be selected in the query. By default, all columns are
  selected (['*']).
- **conditions** (array<string|int, string|bool|int|float|array<int|string, int|string|bool|float|Closure>>): Stores an
  associative array that defines the filtering conditions for the query. The key of the array represents the column name
  and the value represents the value(s) to be compared. Conditions can also be arrays specifying the operator to use.
- **distinct** (bool): Indicates whether to apply a DISTINCT clause to the query. Defaults to false.