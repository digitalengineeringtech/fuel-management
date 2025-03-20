<?php

namespace App\Repositories\Cloud\Concretes\Discounts;

use App\Http\Resources\Cloud\Discounts\DiscountResource;
use App\Models\Discount;
use App\Repositories\Cloud\Contracts\Discounts\DiscountRepositoryInterface;
use App\Traits\HasResponse;
use Exception;

class DiscountRepository implements DiscountRepositoryInterface
{
    use HasResponse;

    public function getDiscounts($request)
    {
        try {
            $discounts = Discount::paginate(10);

            if (! $discounts) {
                return $this->errorResponse('Discount not found', 404, null);
            }

            return $this->successResponse('Discount successfully retrieved', 200, DiscountResource::collection($discounts));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getDiscount($id)
    {
        try {
            $discount = Discount::find($id);

            if (! $discount) {
                return $this->errorResponse('Discount not found', 404, null);
            }

            return $this->successResponse('Discount successfully retrieved', 200, new DiscountResource($discount));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createDiscount($data)
    {
        try {

            // Create a new discount
            $discount = Discount::create($data);

            if (! $discount) {
                return $this->errorResponse('Discount not found', 404, null);
            }

            return $this->successResponse('Discount successfully created', 201, new DiscountResource($discount));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateDiscount($id, $data)
    {
        try {
            // find the discount by id
            $discount = Discount::find($id);

            // if the discount doesn't exist, return an error response
            if (! $discount) {
                return $this->errorResponse('Discount not found', 404, null);
            }

            // update the discount
            $discount->update($data);

            return $this->successResponse('Discount successfully updated', 200, new DiscountResource($discount));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteDiscount($id)
    {
        try {
            // find the discount by id
            $discount = Discount::find($id);

            // if the discount doesn't exist, return an error response
            if (! $discount) {
                return $this->errorResponse('Discount not found', 404, null);
            }

            // Delete the discount's database
            $discount->delete();

            return $this->successResponse('Discount successfully deleted', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
