<?php

namespace App\Repositories\Local\Contracts\Sales;


/**
 * Interface defining the contract for a sale repository.
 * This interface provides methods for managing sales, including
 * retrieving a list of sales, getting details of a specific sale,
 * creating a new sale, updating an existing sale, and deleting a sale.
 */
interface SaleRepositoryInterface
{
    /** *
     * Get a list of sales based on the provided query
     */
    public function getSales($request);

    /**
     * Get a specific sale by its ID.
     *
     * @param  int  $id
     */
    public function getSale($id);

    /**
     * Create a new sale with the provided data.
     *
     * @param  array  $data
     */
    public function createSale($data);

    /**
     * Update an existing sale by its ID and update the provided data.
     *
     * @param  int  $id
     * @param  array  $data
     */
    public function updateSale($id, $data);
    /**
     *  Delete a sale by its ID.
     *
     * @param  int  $id
     */
    public function deleteSale($id);

    /**
     * Create Preset Sale Request
     * @param string $type = liter or kyat ( default kyat )
     * @param array $data
     */
    public function presetSale($type, $data);

    /**
     *  Approve By Casher Sale Data
     * @param array $data
     */
    public function cashierSale($data);
}
