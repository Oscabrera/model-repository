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
