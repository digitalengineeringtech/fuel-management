<?php

namespace App\Repositories\Cloud\Contracts\StockPrices;

/**
 * Interface defining the contract for a stock price repository.
 * This interface provides methods for managing stock prices, including
 * retrieving a list of stock prices, getting details of a specific stock prices,
 * creating a new stock price, updating an existing stock price, and deleting a stock price.
 */
interface StockPriceRepositoryInterface
{
    /** *
     * Get a list of stock prices based on the provided query
     * @param $request
     */
    public function getStockPrices($request);
    /**
     * Get a specific stock price by its ID.
     * @param int $id
    */
    public function getStockPrice($id);

    /**
     * Create a new stock price with the provided data.
     * @param array $data
    */
    public function createStockPrice($data);

    /**
     * Update an existing stock price by its ID and update the provided data.
     * @param int $id
     * @param array $data
    */
    public function updateStockPrice($id, $data);

    /**
     *  Delete a stock price by its ID.
     * @param int $id
    */
    public function deleteStockPrice($id);
}
