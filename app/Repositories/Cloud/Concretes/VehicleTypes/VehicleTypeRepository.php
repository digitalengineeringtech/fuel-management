<?php

namespace App\Repositories\Cloud\Concretes\VehicleTypes;

use Exception;
use App\Traits\HasImage;
use App\Models\VehicleType;
use App\Traits\HasResponse;
use App\Http\Resources\Cloud\VehicleTypes\VehicleTypeResource;
use App\Repositories\Cloud\Contracts\VehicleTypes\VehicleTypeRepositoryInterface;

class VehicleTypeRepository implements VehicleTypeRepositoryInterface
{
    use HasImage;

    use HasResponse;

    public function getVehicleTypes($request)
    {
        try {
            $vehicleTypes = VehicleType::paginate(10);

            if(!$vehicleTypes) {
                return $this->errorResponse('Failed to get vehicleTypes', 400, null);
            }

            return $this->successResponse('VehicleTypes successfully retrieved', 200, VehicleTypeResource::collection($vehicleTypes));
        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getVehicleType($id)
    {
        try {
            $vehicleType = VehicleType::find($id);

            if (! $vehicleType) {
                return $this->errorResponse('VehicleType not found', 404, null);
            }

            return $this->successResponse('VehicleType successfully retrieved', 200, new VehicleTypeResource($vehicleType));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createVehicleType($data)
    {
        try {

            if (isset($data['image'])) {
                $data['image'] = $this->uploadImage('vehicleTypes', $data['image']);
            }
            // Create a new vehicleType
            $vehicleType = VehicleType::create($data);

            if(!$vehicleType) {
                return $this->errorResponse('Failed to create vehicleType', 400, null);
            }

            return $this->successResponse('VehicleType updated successfully', 200, new VehicleTypeResource($vehicleType));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateVehicleType($id, $data)
    {
        try {
            if (isset($data['image'])) {
                $data['image'] = $this->uploadImage('vehicleTypes', $data['image']);
            }
            // find the vehicleType by id
            $vehicleType = VehicleType::find($id);

            // if the vehicleType doesn't exist, return an error response
            if (! $vehicleType) {
                return $this->errorResponse('Fuel Type not found', 404, null);
            }

            // update the vehicleType
            $vehicleType->update($data);

            return $this->successResponse('VehicleType updated successfully', 200, new VehicleTypeResource($vehicleType));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteVehicleType($id)
    {
        try {
            // find the vehicleType by id
            $vehicleType = VehicleType::find($id);

            // if the vehicleType doesn't exist, return an error response
            if (! $vehicleType) {
                return $this->errorResponse('VehicleType not found', 404, null);
            }

            // Delete the vehicleType's database
            $vehicleType->delete();

            return $this->successResponse('VehicleType deleted successfully', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
