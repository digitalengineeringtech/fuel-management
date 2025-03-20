<?php

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can get all customers and response with resource', function () {
    Customer::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/cloud/customers');

    $response->assertStatus(200)
        ->assertJsonCount(5, 'data');
});

it('can get customer by id and response with resource', function () {
    $customer = Customer::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/cloud/customers/{$customer->id}");

    $response->assertStatus(200)
        ->assertJsonPath('data.id', $customer->id);
});

it('can create customer and response with resource', function () {
    $customerData = Customer::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/cloud/customers', $customerData);

    $response->assertStatus(201);
});

it('can update customer and response with resource', function () {
    $customer = Customer::factory()->create();

    $updatedData = Customer::factory()->make(['name' => 'Updated Name'])->toArray();

    $response = $this->actingAs($this->user)->put("/api/cloud/customers/{$customer->id}", $updatedData);

    $response->assertStatus(200);
});

it('can delete customer and response with resource', function () {
    $customer = Customer::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/cloud/customers/{$customer->id}");

    $response->assertStatus(200);
});
