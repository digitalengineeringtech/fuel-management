<?php

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('can get all payments and response with resource', function () {
    Payment::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/cloud/payments');

    $response->assertStatus(200)
        ->assertJsonCount(5, 'data');
});

test('can get payment by id and response with resource', function () {
    $payment = Payment::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/cloud/payments/{$payment->id}");

    $response->assertStatus(200);
});

test('can create payment and response with resource', function () {
    $paymentData = Payment::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/cloud/payments', $paymentData);

    $response->assertStatus(201);
});

test('can update payment and response with resource', function () {
    $payment = Payment::factory()->create();

    $updatedData = Payment::factory()->make(['name' => 'GG'])->toArray();

    $response = $this->actingAs($this->user)->put("/api/cloud/payments/{$payment->id}", $updatedData);

    $response->assertStatus(200);
});

test('can delete payment and response with resource', function () {
    $payment = Payment::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/cloud/payments/{$payment->id}");

    $response->assertStatus(200);
});
