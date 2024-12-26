<?php

namespace App\Repositories\Cloud\Concretes\Discounts;

use Exception;
use App\Models\Discount;
use App\Traits\HasResponse;
use App\Http\Resources\Cloud\Discounts\DiscountResource;
use App\Repositories\Cloud\Contracts\Discounts\DiscountRepositoryInterface;

class DiscountRepository implements DiscountRepositoryInterface
{
     use HasResponse;
     public function getDiscounts($request)
     {
         $discounts = Discount::paginate(10);

         return DiscountResource::collection($discounts);
     }

     public function getDiscount($id)
     {
         $discount = Discount::find($id);

         if(!$discount) {
             return $this->errorResponse('Discount not found', 404, null);
         }

         return new DiscountResource($discount);
     }

     public function createDiscount($data)
     {
          try {

                // Create a new discount
                $discount = Discount::create($data);

                return new DiscountResource($discount);

          } catch(Exception $e) {
              return $this->errorResponse($e->getMessage(), 500,  null);;
          }
     }

     public function updateDiscount($id, $data)
     {

         // find the discount by id
         $discount = Discount::find($id);

         // if the discount doesn't exist, return an error response
         if(!$discount) {
            return $this->errorResponse('Discount not found', 404, null);
         }

         // update the discount
         $discount->update($data);

         return new DiscountResource($discount);
     }

     public function deleteDiscount($id)
     {
        // find the discount by id
        $discount = Discount::find($id);

        // if the discount doesn't exist, return an error response
        if(!$discount) {
            return $this->errorResponse('Discount not found', 404, null);
        }

         // Delete the discount's database
         $discount->delete();

         return $this->successResponse('Discount deleted successfully', 200, null);
     }


}
