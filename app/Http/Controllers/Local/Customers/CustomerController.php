<?php

namespace App\Http\Controllers\Local\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Customers\CreateRequest;
use App\Http\Requests\Local\Customers\UpdateRequest;
use App\Repositories\Local\Contracts\Customers\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->customerRepository->getCustomers($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->customerRepository->createCustomer($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->customerRepository->getCustomer($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->customerRepository->updateCustomer($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->customerRepository->deleteCustomer($id);
    }
}
