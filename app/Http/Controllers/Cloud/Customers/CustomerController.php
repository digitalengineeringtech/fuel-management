<?php

namespace App\Http\Controllers\Cloud\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\Customers\CreateRequest;
use App\Http\Requests\Cloud\Customers\UpdateRequest;
use App\Http\Resources\Cloud\Customers\CustomerResource;
use App\Repositories\Cloud\Contracts\Customers\CustomerRepositoryInterface;

class CustomerController extends Controller
{
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * All Customers
     *
     * @response array{message: string, code: int, data: CustomerResource[]}
     */
    public function index(Request $request)
    {
        return $this->customerRepository->getCustomers($request);
    }

    /**
     * Create Customer
     *
     * @response array{message: string, code: int, data: CustomerResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->customerRepository->createCustomer($request->validated());
    }

    /**
     * Single Customer
     *
     * @response array{message: string, code: int, data: CustomerResource}
     */
    public function show($id)
    {
        return $this->customerRepository->getCustomer($id);
    }

    /**
     * Update Customer
     *
     * @response array{message: string, code: int, data: CustomerResource}
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->customerRepository->updateCustomer($id, $request->validated());
    }

    /**
     * Delete Customer
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy($id)
    {
        return $this->customerRepository->deleteCustomer($id);
    }
}
