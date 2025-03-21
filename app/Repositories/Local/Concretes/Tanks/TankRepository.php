<?php

namespace App\Repositories\Local\Concretes\Tanks;

use App\Http\Resources\Local\Tanks\TankResource;
use App\Models\Tank;
use App\Repositories\Local\Contracts\Tanks\TankRepositoryInterface;
use App\Traits\HasResponse;
use Exception;

class TankRepository implements TankRepositoryInterface
{
    use HasResponse;

    public function getTanks($request)
    {
        try {
            $tanks = Tank::paginate(10);

            if (! $tanks) {
                return $this->errorResponse('Tanks not found', 404, null);
            }

            return TankResource::collection($tanks);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getTank($id)
    {
        try {
            $tank = Tank::find($id);

            if (! $tank) {
                return $this->errorResponse('Tank not found', 404, null);
            }

            return $this->successResponse('Tank found successfully', 200, new TankResource($tank));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createTank($data)
    {
        try {
            $tank = Tank::create($data);

            if (! $tank) {
                return $this->errorResponse('Failed to create tank', 400, null);
            }

            return $this->successResponse('Tank successfully created', 201, new TankResource($tank));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateTank($id, $data)
    {
        try {
            $tank = Tank::find($id);

            if (! $tank) {
                return $this->errorResponse('Tank not found', 404, null);
            }

            $tank->update($data);

            return $this->successResponse('Tank successfully updated', 200, new TankResource($tank));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteTank($id)
    {
        try {
            $tank = Tank::find($id);

            if (! $tank) {
                return $this->errorResponse('Tank not found', 404, null);
            }

            $tank->delete();

            return $this->successResponse('Tank successfully deleted', 200, null);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
