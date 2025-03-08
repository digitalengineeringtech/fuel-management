<?php

namespace App\Repositories\Local\Contracts\FuelIns;

/**
 * Interface defining the contract for a fuelIn repository.
 * This interface provides methods for managing fuelIns, including
 * retrieving a list of fuelIns, getting details of a specific fuelIn,
 * creating a new fuelIn, updating an existing fuelIn, and deleting a fuelIn.
 */
interface FuelInRepositoryInterface
{
    /** *
     * Get a list of fuelIns based on the provided query
     */
    public function getFuelIns($request);

    /**
     * Get a specific fuelIn by its ID.
     *
     * @param  int  $id
     */
    public function getFuelIn($id);

    /**
     * Create a new fuelIn with the provided data.
     *
     * @param  array  $data
     */
    public function createFuelIn($data);

    /**
     * Update an existing fuelIn by its ID and update the provided data.
     *
     * @param  int  $id
     * @param  array  $data
     */
    public function updateFuelIn($id, $data);

    /**
     *  Delete a fuelIn by its ID.
     *
     * @param  int  $id
     */
    public function deleteFuelIn($id);
}
