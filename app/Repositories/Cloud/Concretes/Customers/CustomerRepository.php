<?php

namespace App\Repositories\Cloud\Concretes\Customers;

use App\Http\Resources\Cloud\Customers\CustomerResource;
use App\Models\Customer;
use App\Repositories\Cloud\Contracts\Customers\CustomerRepositoryInterface;
use App\Traits\HasResponse;
use Exception;
use Illuminate\Support\Facades\Response;

class CustomerRepository implements CustomerRepositoryInterface
{
    use HasResponse;

    public function getCustomers($request)
    {
        try {
            $customers = Customer::paginate(10);

            if (! $customers) {
                return $this->errorResponse('Customers not found', 404, null);
            }

            return CustomerResource::collection($customers);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getCustomer($id)
    {
        try {
            $customer = Customer::find($id);

            if (! $customer) {
                return $this->errorResponse('Customer not found', 404, null);
            }

            return $this->successResponse('Customer successfully retrieved', 200, new CustomerResource($customer));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createCustomer($data)
    {
        try {
            // Create a new customer
            $customer = Customer::create($data);

            if (! $customer) {
                return $this->errorResponse('Customer not created', 500, null);
            }

            return $this->successResponse('Customer successfully created', 201, new CustomerResource($customer));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateCustomer($id, $data)
    {
        try {
            // find the customer by id
            $customer = Customer::find($id);

            // if the customer doesn't exist, return an error response
            if (! $customer) {
                return $this->errorResponse('Customer not found', 404, null);
            }

            // update the customer
            $customer->update($data);

            return $this->successResponse('Customer successfully updated', 200, new CustomerResource($customer));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteCustomer($id)
    {
        try {
            // find the customer by id
            $customer = Customer::find($id);

            // if the customer doesn't exist, return an error response
            if (! $customer) {
                return $this->errorResponse('Customer not found', 404, null);
            }

            // Delete the customer's database
            $customer->delete();

            return $this->successResponse('Customer deleted successfully', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
