<?php

namespace App\Repositories\Cloud\Contracts\Stations;

/**
 * Interface defining the contract for a station repository.
 * This interface provides methods for managing stations, including
 * retrieving a list of stations, getting details of a specific station,
 * creating a new station, updating an existing station, and deleting a station.
 */
interface StationRepositoryInterface
{
    /** *
     * Get a list of stations based on the provided query
     */
    public function getStations($request);

    /**
     * Get a specific station by its ID.
     *
     * @param  int  $id
     */
    public function getStation($id);

    /**
     * Create a new station with the provided data.
     *
     * @param  array  $data
     */
    public function createStation($data);

    /**
     * Update an existing station by its ID and update the provided data.
     *
     * @param  int  $id
     * @param  array  $data
     */
    public function updateStation($id, $data);

    /**
     *  Delete a station by its ID.
     *
     * @param  int  $id
     */
    public function deleteStation($id);
}
