<?php

namespace App\Repositories\Local\Contracts\Nozzles;

/**
 * Interface defining the contract for a nozzle repository.
 * This interface provides methods for managing nozzles, including
 * retrieving a list of nozzles, getting details of a specific nozzle,
 * creating a new nozzle, updating an existing nozzle, and deleting a nozzle.
 */
interface NozzleRepositoryInterface
{
    /** *
     * Get a list of dispensers based on the provided query
     */
    public function getNozzles($request);

    /**
     * Get a specific nozzle by its ID.
     *
     * @param  int  $id
     */
    public function getNozzle($id);

    /**
     * Create a new nozzle with the provided data.
     *
     * @param  array  $data
     */
    public function createNozzle($data);

    /**
     * Update an existing nozzle by its ID and update the provided data.
     *
     * @param  int  $id
     * @param  array  $data
     */
    public function updateNozzle($id, $data);

    /**
     *  Delete a nozzle by its ID.
     *
     * @param  int  $id
     */
    public function deleteNozzle($id);
}
