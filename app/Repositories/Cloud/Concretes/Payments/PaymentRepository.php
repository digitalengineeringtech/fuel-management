<?php

namespace App\Repositories\Cloud\Concretes\Payments;

use App\Http\Resources\Cloud\Payments\PaymentResource;
use App\Models\Payment;
use App\Repositories\Cloud\Contracts\Payments\PaymentRepositoryInterface;
use App\Traits\HasImage;
use App\Traits\HasResponse;
use Exception;

class PaymentRepository implements PaymentRepositoryInterface
{
    use HasImage;
    use HasResponse;

    public function getPayments($request)
    {
        try {
            $payments = Payment::paginate(10);

            if (! $payments) {
                return $this->errorResponse('Failed to get payments', 400, null);
            }

            return PaymentResource::collection($payments);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getPayment($id)
    {
        try {
            $payment = Payment::find($id);

            if (! $payment) {
                return $this->errorResponse('Payment not found', 404, null);
            }

            return $this->successResponse('Payment successfully retrieved', 200, new PaymentResource($payment));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createPayment($data)
    {
        try {

            if (isset($data['image'])) {
                $data['image'] = $this->uploadImage('payments', $data['image']);
            }
            // Create a new payment
            $payment = Payment::create($data);

            if (! $payment) {
                return $this->errorResponse('Failed to create payment', 400, null);
            }

            return $this->successResponse('Payment successfully created', 201, new PaymentResource($payment));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updatePayment($id, $data)
    {
        try {
            if (isset($data['image'])) {
                $data['image'] = $this->uploadImage('payments', $data['image']);
            }
            // find the payment by id
            $payment = Payment::find($id);

            // if the payment doesn't exist, return an error response
            if (! $payment) {
                return $this->errorResponse('Fuel Type not found', 404, null);
            }

            // update the payment
            $payment->update($data);

            return $this->successResponse('Payment successfully updated', 200, new PaymentResource($payment));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deletePayment($id)
    {
        try {
            // find the payment by id
            $payment = Payment::find($id);

            // if the payment doesn't exist, return an error response
            if (! $payment) {
                return $this->errorResponse('Payment not found', 404, null);
            }

            // Delete the payment's database
            $payment->delete();

            return $this->successResponse('Payment deleted successfully', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
