<?php

namespace App\Repositories\Cloud\Concretes\VehicleTypes;

use App\Http\Resources\Cloud\VehicleTypes\VehicleTypeResource;
use Exception;
use App\Traits\HasResponse;
use App\Models\VehicleType;
use App\Repositories\Cloud\Contracts\VehicleTypes\VehicleTypeRepositoryInterface;

class VehicleTypeRepository implements VehicleTypeRepositoryInterface
{

     use HasResponse;
     public function getVehicleTypes($request)
     {
         $vehicle_types = VehicleType::paginate(10);

         return VehicleTypeResource::collection($vehicle_types);
     }

     public function getVehicleType($id)
     {
         $vehicle_type = VehicleType::find($id);

         if(!$vehicle_type) {
             return $this->errorResponse('Vehicle Type not found', 404, null);
         }

         return new VehicleTypeResource($vehicle_type);
     }

     public function createVehicleType($data)
     {
          try {

                // Create a new vehicle_type
                $vehicle_type = VehicleType::create($data);

                return new VehicleTypeResource($vehicle_type);

          } catch(Exception $e) {
              return $this->errorResponse($e->getMessage(), 500,  null);;
          }
     }

     public function updateVehicleType($id, $data)
     {

         // find the vehicle_type by id
         $vehicle_type = VehicleType::find($id);

         // if the vehicle_type doesn't exist, return an error response
         if(!$vehicle_type) {
            return $this->errorResponse('Vehicle Type not found', 404, null);
         }

         // update the vehicle_type
         $vehicle_type->update($data);

         return new VehicleTypeResource($vehicle_type);
     }

     public function deleteVehicleType($id)
     {
        // find the vehicle_type by id
        $vehicle_type = VehicleType::find($id);

        // if the vehicle_type doesn't exist, return an error response
        if(!$vehicle_type) {
            return $this->errorResponse('Vehicle Type not found', 404, null);
        }

         // Delete the vehicle_type's database
         $vehicle_type->delete();

         return $this->successResponse('Vehicle Type deleted successfully', 200, null);
     }


}
