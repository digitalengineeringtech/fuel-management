<?php

namespace App\Repositories\Local\Contracts\Customers;

/**
 * Interface defining the contract for a customer repository.
 * This interface provides methods for managing customers, including
 * retrieving a list of customer, getting details of a specific customer,
 * creating a new customer, updating an existing customer, and deleting a customer.
 */
interface CustomerRepositoryInterface
{
    /** *
     * Get a list of customers based on the provided query
     * @param $request
     */
    public function getCustomers($request);
    /**
     * Get a specific customer by its ID.
     * @param int $id
    */
    public function getCustomer($id);

    /**
     * Create a new customer with the provided data.
     * @param array $data
    */
    public function createCustomer($data);

    /**
     * Update an existing customer by its ID and update the provided data.
     * @param int $id
     * @param array $data
    */
    public function updateCustomer($id, $data);

    /**
     *  Delete a customer by its ID.
     * @param int $id
    */
    public function deleteCustomer($id);
}
