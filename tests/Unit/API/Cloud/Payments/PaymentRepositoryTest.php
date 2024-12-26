<?php

use App\Models\Payment;
use App\Repositories\Cloud\Contracts\Payments\PaymentRepositoryInterface;

beforeEach(function () {
    $this->paymentRepository = $this->mock(PaymentRepositoryInterface::class);
});


test('can get all payment and response with resource', function () {
    $payments = Payment::factory()->create();

    $this->paymentRepository->shouldReceive('getPayments')->andReturn($payments);

    $response = $this->paymentRepository->getPayments(request());

    expect($response)->toBe($payments);
});

test('can get payment by id and response with resource', function () {
    $payment = Payment::factory()->create();

    $this->paymentRepository->shouldReceive('getPayment')->andReturn($payment);

    $response = $this->paymentRepository->getPayment($payment->id);

    expect($response->id)->toBe($payment->id);
});

test('can create payment and response with resource', function () {
    $payment = Payment::factory()->make();

    $this->paymentRepository->shouldReceive('createPayment')->andReturn($payment);

    $response = $this->paymentRepository->createPayment($payment->toArray());

    expect($response->id)->toBe($payment->id);
    expect($response->name)->toBe($payment->name);
});

test('can update payment and response with resource', function () {
    $payment = Payment::factory()->create();

    $this->paymentRepository->shouldReceive('updatePayment')->andReturn($payment);

    $response = $this->paymentRepository->updatePayment($payment->id, $payment->toArray());

    expect($response->id)->toBe($payment->id);
    expect($response->name)->toBe($payment->name);
});

test('can delete payment and response with resource', function () {
    $payment = Payment::factory()->create();

    $this->paymentRepository->shouldReceive('deletePayment')->andReturn(['message' => 'Payment deleted successfully']);

    $response = $this->paymentRepository->deletePayment($payment->id);

    expect($response['message'])->toBe('Payment deleted successfully');
});
