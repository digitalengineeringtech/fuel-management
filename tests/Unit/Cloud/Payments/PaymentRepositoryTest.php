<?php

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
    Storage::fake();

    $paymentData = Payment::factory()->make()->toArray();

    $paymentData['image'] = UploadedFile::fake()->image('payment.png');

    $response = $this->actingAs($this->user)->post('/api/cloud/payments', $paymentData);

    $response->assertStatus(201);
});

test('can update payment and response with resource', function () {
    Storage::fake();

    $payment = Payment::factory()->create();

    $updatedData = Payment::factory()->make(['name' => 'GG'])->toArray();

    $updatedData['image'] = UploadedFile::fake()->image('payment.png');

    $response = $this->actingAs($this->user)->put("/api/cloud/payments/{$payment->id}", $updatedData);

    $response->assertStatus(200);
});

test('can delete payment and response with resource', function () {
    $payment = Payment::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/cloud/payments/{$payment->id}");

    $response->assertStatus(200);
});
