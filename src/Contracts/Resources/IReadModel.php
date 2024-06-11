<?php

namespace Oscabrera\ModelRepository\Contracts\Resources;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface IEntityRead
 *
 * This interface defines a method for reading a record from the database based on the given ID.
 */
interface IReadModel
{
    /**
     * Reads a record from the database based on the given ID.
     *
     * @param string $id The ID of the record to be fetched.
     *
     * @return Model The fetched record.
     */
    public function read(string $id): Model;
}
