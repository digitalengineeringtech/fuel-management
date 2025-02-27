<?php

namespace App\Repositories\Local\Contracts\Dispensers;

/**
 * Interface defining the contract for a dispenser repository.
 * This interface provides methods for managing dispensers, including
 * retrieving a list of dispensers, getting details of a specific dispenser,
 * creating a new dispenser, updating an existing dispenser, and deleting a dispenser.
 */
interface DispenserRepositoryInterface
{
    /** *
     * Get a list of dispensers based on the provided query
     */
    public function getDispensers($request);

    /**
     * Get a specific dispenser by its ID.
     *
     * @param  int  $id
     */
    public function getDispenser($id);

    /**
     * Create a new dispenser with the provided data.
     *
     * @param  array  $data
     */
    public function createDispenser($data);

    /**
     * Update an existing dispenser by its ID and update the provided data.
     *
     * @param  int  $id
     * @param  array  $data
     */
    public function updateDispenser($id, $data);

    /**
     *  Delete a dispenser by its ID.
     *
     * @param  int  $id
     */
    public function deleteDispenser($id);
}
