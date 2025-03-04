<?php

namespace App\Repositories\Local\Concretes\Dispensers;

use Exception;
use App\Models\Dispenser;
use App\Traits\HasResponse;
use App\Http\Resources\Local\Dispensers\DispenserResource;
use App\Repositories\Local\Contracts\Dispensers\DispenserRepositoryInterface;

class DispenserRepository implements DispenserRepositoryInterface
{
    use HasResponse;

    public function getDispensers($request)
    {
        try {
            $dispensers = Dispenser::paginate(10);

            return DispenserResource::collection($dispensers);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getDispenser($id)
    {
        try {
            $dispenser = Dispenser::find($id);

            return new DispenserResource($dispenser);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createDispenser($data)
    {
        try {
            $dispenser = Dispenser::create($data);

            if(!$dispenser) {
                return $this->errorResponse('Failed to create dispenser', 400, null);
            }

            $this->successResponse('Dispenser created successfully', 201, new DispenserResource($dispenser));

        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }

    }

    public function updateDispenser($id, $data)
    {
        try {
            $dispenser = Dispenser::find($id);

            if(!$dispenser) {
                return $this->errorResponse('Dispenser not found', 404, null);
            }

            $dispenser->update($data);

            return $this->successResponse('Dispenser updated successfully', 200, new DispenserResource($dispenser));
        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteDispenser($id)
    {
        try {
            $dispenser = Dispenser::find($id);

            if(!$dispenser) {
                return $this->errorResponse('Dispenser not found', 404, null);
            }

            $dispenser->delete();

            return $this->successResponse('Dispenser deleted successfully', 200, null);
        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
