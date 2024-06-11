# IRepositoryResource

The `IRepositoryResource` interface provides an abstraction for basic CRUD operations and model enumeration. Several
interfaces are exposed to help manage the repositories:

- [ICreateModel](./ICreateModel.md): For creating models.
- [IReadModel](./IReadModel.md): For reading models.
- [IUpdateModel](./IUpdateModel.md): For updating models.
- [IDeleteModel](./IDeleteModel.md): For deleting models.
- [IListModel](./IListModel.md): To list models.

## Code

```php
<?php

namespace Oscabrera\ModelRepository\Contracts\Resources;

/**
 * Interface IEntityResource
 *
 * Defines the contract for an entity resource.
 * the methods for a resource are: create, read, update, delete and list.
 *
 * This class does not contain additional methods to extended interfaces.
 */
interface IRepositoryResource extends
    ICreateModel,
    IReadModel,
    IUpdateModel,
    IDeleteModel,
    IListModel
{
}
```