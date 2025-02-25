<?php

namespace App\Repositories\Local\Concretes\Customers;

use App\Http\Resources\Local\Customers\CustomerResource;
use App\Models\Customer;
use App\Repositories\Local\Contracts\Customers\CustomerRepositoryInterface;
use App\Traits\HasResponse;
use Exception;

class CustomerRepository implements CustomerRepositoryInterface
{
    use HasResponse;

    public function getCustomers($request)
    {
        $customers = Customer::paginate(10);

        return CustomerResource::collection($customers);
    }

    public function getCustomer($id)
    {
        $customer = Customer::find($id);

        if (! $customer) {
            return $this->errorResponse('Customer not found', 404, null);
        }

        return new CustomerResource($customer);
    }

    public function createCustomer($data)
    {
        try {
            // Create a new customer
            $customer = Customer::create($data);

            return new CustomerResource($customer);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateCustomer($id, $data)
    {

        // find the customer by id
        $customer = Customer::find($id);

        // if the customer doesn't exist, return an error response
        if (! $customer) {
            return $this->errorResponse('Customer not found', 404, null);
        }

        // update the customer
        $customer->update($data);

        return new CustomerResource($customer);
    }

    public function deleteCustomer($id)
    {
        // find the customer by id
        $customer = Customer::find($id);

        // if the customer doesn't exist, return an error response
        if (! $customer) {
            return $this->errorResponse('Customer not found', 404, null);
        }

        // Delete the customer's database
        $customer->delete();

        return $this->successResponse('Customer deleted successfully', 200, null);
    }
}
