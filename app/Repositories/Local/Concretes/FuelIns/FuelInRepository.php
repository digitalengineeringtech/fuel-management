<?php

namespace App\Repositories\Local\Concretes\FuelIns;

use App\Http\Resources\Local\FuelIns\FuelInResource;
use App\Models\FuelIn;
use App\Repositories\Local\Contracts\FuelIns\FuelInRepositoryInterface;
use App\Traits\HasResponse;
use Exception;

class FuelInRepository implements FuelInRepositoryInterface
{
    use HasResponse;

    public function getFuelIns($request)
    {
        try {
            $fuelIns = FuelIn::paginate(10);

            return FuelInResource::collection($fuelIns);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function getFuelIn($id)
    {
        try {
            $fuelIn = FuelIn::find($id);

            return new FuelInResource($fuelIn);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createFuelIn($data)
    {
        try {

            $lastFuelIn = FuelIn::where('tank_no', $data['tank_no'])
                ->orderBy('code', 'desc')
                ->first();

            $data['code'] = $lastFuelIn ? $lastFuelIn->code + 1 : 1;

            $fuelIn = FuelIn::create($data);

            if (! $fuelIn) {
                return $this->errorResponse('Failed to create fuelIn', 400, null);
            }

            return $this->successResponse('FuelIn created successfully', 201, new FuelInResource($fuelIn));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateFuelIn($id, $data)
    {
        try {
            $fuelIn = FuelIn::find($id);

            if (! $fuelIn) {
                return $this->errorResponse('FuelIn not found', 404, null);
            }

            $fuelIn->update($data);

            return $this->successResponse('FuelIn updated successfully', 200, new FuelInResource($fuelIn));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteFuelIn($id)
    {
        try {
            $fuelIn = FuelIn::find($id);

            if (! $fuelIn) {
                return $this->errorResponse('FuelIn not found', 404, null);
            }

            $fuelIn->delete();

            return $this->successResponse('FuelIn deleted successfully', 200, null);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
