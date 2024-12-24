<?php

namespace App\Repositories\Cloud\Concretes\Payments;

use Exception;
use App\Traits\HasResponse;
use App\Http\Resources\Cloud\Payments\PaymentResource;
use App\Models\Payment;
use App\Repositories\Cloud\Contracts\Payments\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
     use HasResponse;
     public function getPayments($request)
     {
         $payments = Payment::paginate(10);

         return PaymentResource::collection($payments);
     }

     public function getPayment($id)
     {
         $payment = Payment::find($id);

         if(!$payment) {
             return $this->errorResponse('Payment not found', 404, null);
         }

         return new PaymentResource($payment);
     }

     public function createPayment($data)
     {
          try {

                // Create a new payment
                $payment = Payment::create($data);

                return new PaymentResource($payment);

          } catch(Exception $e) {
              return $this->errorResponse($e->getMessage(), 500,  null);;
          }
     }

     public function updatePayment($id, $data)
     {

         // find the payment by id
         $payment = Payment::find($id);

         // if the payment doesn't exist, return an error response
         if(!$payment) {
            return $this->errorResponse('Fuel Type not found', 404, null);
         }

         // update the payment
         $payment->update($data);

         return new PaymentResource($payment);
     }

     public function deletePayment($id)
     {
        // find the payment by id
        $payment = Payment::find($id);

        // if the payment doesn't exist, return an error response
        if(!$payment) {
            return $this->errorResponse('Payment not found', 404, null);
        }

         // Delete the payment's database
         $payment->delete();

         return $this->successResponse('Payment deleted successfully', 200, null);
     }


}
