<?php

namespace App\Repositories\Cloud\Contracts\VehicleTypes;

/**
 * Interface defining the contract for a vehicle type repository.
 * This interface provides methods for managing vehicle types, including
 * retrieving a list of vehicle types, getting details of a specific vehicle type,
 * creating a new vehicle type, updating an existing vehicle type, and deleting a vehicle type.
 */
interface VehicleTypeRepositoryInterface
{
    /** *
     * Get a list of vehicle types based on the provided query
     */
    public function getVehicleTypes($request);

    /**
     * Get a specific vehicle type by its ID.
     *
     * @param  int  $id
     */
    public function getVehicleType($id);

    /**
     * Create a new vehicle type with the provided data.
     *
     * @param  array  $data
     */
    public function createVehicleType($data);

    /**
     * Update an existing vehicle type by its ID and update the provided data.
     *
     * @param  int  $id
     * @param  array  $data
     */
    public function updateVehicleType($id, $data);

    /**
     *  Delete a vehicle by its ID.
     *
     * @param  int  $id
     */
    public function deleteVehicleType($id);
}
