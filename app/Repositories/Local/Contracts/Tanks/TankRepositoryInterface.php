<?php

namespace App\Repositories\Local\Contracts\Tanks;


/**
 * Interface defining the contract for a tank repository.
 * This interface provides methods for managing tanks, including
 * retrieving a list of tanks, getting details of a specific tank,
 * creating a new tank, updating an existing tank, and deleting a tank.
 */
interface TankRepositoryInterface
{
    /** *
     * Get a list of tanks based on the provided query
     */
    public function getTanks($request);

    /**
     * Get a specific tank by its ID.
     *
     * @param  int  $id
     */
    public function getTank($id);

    /**
     * Create a new tank with the provided data.
     *
     * @param  array  $data
     */
    public function createTank($data);

    /**
     * Update an existing tank by its ID and update the provided data.
     *
     * @param  int  $id
     * @param  array  $data
     */
    public function updateTank($id, $data);

    /**
     *  Delete a tank by its ID.
     *
     * @param  int  $id
     */
    public function deleteTank($id);
}
