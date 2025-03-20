<?php

namespace App\Http\Controllers\Cloud\VehicleTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\VehicleTypes\CreateRequest;
use App\Http\Requests\Cloud\VehicleTypes\UpdateRequest;
use App\Repositories\Cloud\Contracts\VehicleTypes\VehicleTypeRepositoryInterface;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    private $vehicleTypeRepository;

    public function __construct(VehicleTypeRepositoryInterface $vehicleTypeRepository)
    {
        $this->vehicleTypeRepository = $vehicleTypeRepository;
    }

    /**
     * All Vehicle Types
     *
     * @response array{message: string, code: int, data: VehicleTypeResource[]}
     */
    public function index(Request $request)
    {
        return $this->vehicleTypeRepository->getVehicleTypes($request);
    }

    /**
     * Create Vehicle Type
     *
     * @response array{message: string, code: int, data: VehicleTypeResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->vehicleTypeRepository->createVehicleType($request->validated());
    }

    /**
     * Single Vehicle Type
     *
     * @response array{message: string, code: int, data: VehicleTypeResource}
     */
    public function show($id)
    {
        return $this->vehicleTypeRepository->getVehicleType($id);
    }

    /**
     * Update Vehicle Type
     *
     * @response array{message: string, code: int, data: VehicleTypeResource}
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->vehicleTypeRepository->updateVehicleType($id, $request->validated());
    }

    /**
     * Delete Vehicle Type
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy($id)
    {
        return $this->vehicleTypeRepository->deleteVehicleType($id);
    }
}
