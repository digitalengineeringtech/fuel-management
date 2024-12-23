<?php

namespace App\Repositories\Cloud\Concretes\FuelTypes;

use Exception;
use App\Models\FuelType;
use App\Traits\HasResponse;
use App\Http\Resources\Cloud\FuelTypes\FuelTypeResource;
use App\Repositories\Cloud\Contracts\FuelTypes\FuelTypeRepositoryInterface;

class FuelTypeRepository implements FuelTypeRepositoryInterface
{
     use HasResponse;
     public function getFuelTypes($request)
     {
         $fuel_types = FuelType::paginate(10);

         return FuelTypeResource::collection($fuel_types);
     }

     public function getFuelType($id)
     {
         $fuel_type = FuelType::find($id);

         if(!$fuel_type) {
             return $this->errorResponse('Fuel Type not found', 404, null);
         }

         return new FuelTypeResource($fuel_type);
     }

     public function createFuelType($data)
     {
          try {

                // Create a new fuel_type
                $fuel_type = FuelType::create($data);

                return new FuelTypeResource($fuel_type);

          } catch(Exception $e) {
              return $this->errorResponse($e->getMessage(), 500,  null);;
          }
     }

     public function updateFuelType($id, $data)
     {

         // find the fuel_type by id
         $fuel_type = FuelType::find($id);

         // if the fuel_type doesn't exist, return an error response
         if(!$fuel_type) {
            return $this->errorResponse('Fuel Type not found', 404, null);
         }

         // update the fuel_type
         $fuel_type->update($data);

         return new FuelTypeResource($fuel_type);
     }

     public function deleteFuelType($id)
     {
        // find the fuel_type by id
        $fuel_type = FuelType::find($id);

        // if the fuel_type doesn't exist, return an error response
        if(!$fuel_type) {
            return $this->errorResponse('Fuel Type not found', 404, null);
        }

         // Delete the fuel_type's database
         $fuel_type->delete();

         return $this->successResponse('Fuel Type deleted successfully', 200, null);
     }


}
