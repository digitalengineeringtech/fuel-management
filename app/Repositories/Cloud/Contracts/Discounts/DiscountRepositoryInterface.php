<?php

namespace App\Repositories\Cloud\Contracts\Discounts;

/**
 * Interface defining the contract for a discount repository.
 * This interface provides methods for managing discounts, including
 * retrieving a list of discounts, getting details of a specific discount,
 * creating a new discount, updating an existing discount, and deleting a discount.
 */
interface DiscountRepositoryInterface
{
    /** *
     * Get a list of discounts based on the provided query
     */
    public function getDiscounts($request);

    /**
     * Get a specific discount by its ID.
     *
     * @param  int  $id
     */
    public function getDiscount($id);

    /**
     * Create a new discount with the provided data.
     *
     * @param  array  $data
     */
    public function createDiscount($data);

    /**
     * Update an existing discount by its ID and update the provided data.
     *
     * @param  int  $id
     * @param  array  $data
     */
    public function updateDiscount($id, $data);

    /**
     *  Delete a vehicle by its ID.
     *
     * @param  int  $id
     */
    public function deleteDiscount($id);
}
