<?php

namespace App\Repositories\Cloud\Concretes\FuelTypes;

use App\Http\Resources\Cloud\FuelTypes\FuelTypeResource;
use App\Models\FuelType;
use App\Repositories\Cloud\Contracts\FuelTypes\FuelTypeRepositoryInterface;
use App\Traits\HasResponse;
use Exception;

class FuelTypeRepository implements FuelTypeRepositoryInterface
{
    use HasResponse;

    public function getFuelTypes($request)
    {
        try {
            $fuelTypes = FuelType::paginate(10);

            if (! $fuelTypes) {
                return $this->errorResponse('FuelType not found', 404, null);
            }

            return FuelTypeResource::collection($fuelTypes);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getFuelType($id)
    {
        try {
            $fuelType = FuelType::find($id);

            if (! $fuelType) {
                return $this->errorResponse('FuelType not found', 404, null);
            }

            return $this->successResponse('FuelType successfully retrieved', 200, new FuelTypeResource($fuelType));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createFuelType($data)
    {
        try {

            // Create a new fuelType
            $fuelType = FuelType::create($data);

            if (! $fuelType) {
                return $this->errorResponse('FuelType not found', 404, null);
            }

            return $this->successResponse('FuelType successfully updated', 201, new FuelTypeResource($fuelType));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateFuelType($id, $data)
    {
        try {
            // find the fuelType by id
            $fuelType = FuelType::find($id);

            // if the fuelType doesn't exist, return an error response
            if (! $fuelType) {
                return $this->errorResponse('FuelType not found', 404, null);
            }

            // update the fuelType
            $fuelType->update($data);

            return $this->successResponse('FuelType successfully updated', 200, new FuelTypeResource($fuelType));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteFuelType($id)
    {
        try {
            // find the fuelType by id
            $fuelType = FuelType::find($id);

            // if the fuelType doesn't exist, return an error response
            if (! $fuelType) {
                return $this->errorResponse('FuelType not found', 404, null);
            }

            // Delete the fuelType's database
            $fuelType->delete();

            return $this->successResponse('FuelType deleted successfully', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
