<?php

use App\Models\Customer;
use App\Repositories\Local\Contracts\Customers\CustomerRepositoryInterface;

beforeEach(function () {
    $this->customerRepository = $this->mock(CustomerRepositoryInterface::class);
});


test('can get all customers and response with resource', function () {
    $customers = Customer::factory()->create();

    $this->customerRepository->shouldReceive('getCustomers')->andReturn($customers);

    $response = $this->customerRepository->getCustomers(request());

    expect($response)->toBe($customers);
});

test('can get customer by id and response with resource', function () {
    $customer = Customer::factory()->create();

    $this->customerRepository->shouldReceive('getCustomer')->andReturn($customer);

    $response = $this->customerRepository->getCustomer($customer->id);

    expect($response->id)->toBe($customer->id);
});

test('can create customer and response with resource', function () {
    $customer = Customer::factory()->make();

    $this->customerRepository->shouldReceive('createCustomer')->andReturn($customer);

    $response = $this->customerRepository->createCustomer($customer->toArray());

    expect($response->id)->toBe($customer->id);
    expect($response->name)->toBe($customer->name);
});

test('can update customer and response with resource', function () {
    $customer = Customer::factory()->create();

    $this->customerRepository->shouldReceive('updateCustomer')->andReturn($customer);

    $response = $this->customerRepository->updateCustomer($customer->id, $customer->toArray());

    expect($response->id)->toBe($customer->id);
    expect($response->name)->toBe($customer->name);
});

test('can delete customer and response with resource', function () {
    $customer = Customer::factory()->create();

    $this->customerRepository->shouldReceive('deleteCustomer')->andReturn(['message' => 'Customer deleted successfully']);

    $response = $this->customerRepository->deleteCustomer($customer->id);

    expect($response['message'])->toBe('Customer deleted successfully');
});
