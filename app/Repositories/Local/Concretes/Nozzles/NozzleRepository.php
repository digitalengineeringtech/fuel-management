<?php

namespace App\Repositories\Local\Concretes\Nozzles;

use App\Http\Resources\Local\Nozzles\NozzleResource;
use App\Models\Nozzle;
use App\Repositories\Local\Contracts\Nozzles\NozzleRepositoryInterface;
use App\Traits\HasResponse;

class NozzleRepository implements NozzleRepositoryInterface
{
    use HasResponse;

    public function getNozzles($request)
    {
        try {
            $nozzles = Nozzle::paginate(10);

            if (! $nozzles) {
                return $this->errorResponse('Nozzle not found', 404, null);
            }

            return NozzleResource::collection($nozzles);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getNozzle($id)
    {
        try {
            $nozzle = Nozzle::find($id);

            if (! $nozzle) {
                return $this->errorResponse('Nozzle not found', 404, null);
            }

            return $this->successResponse('Nozzle found successfully', 200, new NozzleResource($nozzle));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createNozzle($data)
    {
        try {
            $nozzle = Nozzle::create($data);

            if (! $nozzle) {
                return $this->errorResponse('Failed to create nozzle', 400, null);
            }

            return $this->successResponse('Nozzle successfully created', 201, new NozzleResource($nozzle));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateNozzle($id, $data)
    {
        try {
            $nozzle = Nozzle::find($id);

            if (! $nozzle) {
                return $this->errorResponse('Nozzle not found', 404, null);
            }

            $nozzle->update($data);

            return $this->successResponse('Nozzle successfully updated', 200, new NozzleResource($nozzle));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteNozzle($id)
    {
        try {
            $nozzle = Nozzle::find($id);

            if (! $nozzle) {
                return $this->errorResponse('Nozzle not found', 404, null);
            }

            $nozzle->delete();

            return $this->successResponse('Nozzle successfully deleted', 200, null);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
