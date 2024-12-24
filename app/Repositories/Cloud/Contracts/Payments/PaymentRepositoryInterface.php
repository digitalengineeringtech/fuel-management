<?php

namespace App\Repositories\Cloud\Contracts\Payments;

/**
 * Interface defining the contract for a payments repository.
 * This interface provides methods for managing payment, including
 * retrieving a list of payment, getting details of a specific payment,
 * creating a new payment, updating an existing payment, and deleting a payment.
 */
interface PaymentRepositoryInterface
{
    /** *
     * Get a list of payments based on the provided query
     * @param $request
     */
    public function getPayments($request);
    /**
     * Get a specific payment by its ID.
     * @param int $id
    */
    public function getPayment($id);

    /**
     * Create a new payment with the provided data.
     * @param array $data
    */
    public function createPayment($data);

    /**
     * Update an existing payment by its ID and update the provided data.
     * @param int $id
     * @param array $data
    */
    public function updatePayment($id, $data);

    /**
     *  Delete a payment by its ID.
     * @param int $id
    */
    public function deletePayment($id);
}
