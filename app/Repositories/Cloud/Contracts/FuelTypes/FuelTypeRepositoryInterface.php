<?php

namespace App\Repositories\Cloud\Contracts\FuelTypes;

/**
 * Interface defining the contract for a fuel_type repository.
 * This interface provides methods for managing fuel_types, including
 * retrieving a list of fuel_types, getting details of a specific fuel_type,
 * creating a new fuel_type, updating an existing fuel_type, and deleting a fuel_type.
 */
interface FuelTypeRepositoryInterface
{
    /** *
     * Get a list of fuel_types based on the provided query
     * @param $request
     */
    public function getFuelTypes($request);
    /**
     * Get a specific fuel_type by its ID.
     * @param int $id
    */
    public function getFuelType($id);

    /**
     * Create a new fuel_type with the provided data.
     * @param array $data
    */
    public function createFuelType($data);

    /**
     * Update an existing fuel_type by its ID and update the provided data.
     * @param int $id
     * @param array $data
    */
    public function updateFuelType($id, $data);

    /**
     *  Delete a fuel_type by its ID.
     * @param int $id
    */
    public function deleteFuelType($id);
}
