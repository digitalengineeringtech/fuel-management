<?php

namespace App\Repositories\Cloud\Contracts\Shops;


/**
 * Interface defining the contract for a shop repository.
 * This interface provides methods for managing shops, including
 * retrieving a list of shops, getting details of a specific shop,
 * creating a new shop, updating an existing shop, and deleting a shop.
 */
interface ShopRepositoryInterface
{
    /** *
     * Get a list of shops based on the provided query
     * @param $request
     */
    public function getShops($request);
    /**
     * Get a specific shop by its ID.
     * @param int $id
    */
    public function getShop($id);

    /**
     * Create a new shop with the provided data.
     * @param array $data
    */
    public function createShop($data);

    /**
     * Update an existing shop by its ID and update the provided data.
     * @param int $id
     * @param array $data
    */
    public function updateShop($id, $data);

    /**
     *  Delete a shop by its ID.
     * @param int $id
    */
    public function deleteShop($id);
}
