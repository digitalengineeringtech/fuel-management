<?php

namespace App\Http\Controllers\Cloud\VehicleTypes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\VehicleTypes\CreateRequest;
use App\Http\Requests\Cloud\VehicleTypes\UpdateRequest;
use App\Repositories\Cloud\Contracts\VehicleTypes\VehicleTypeRepositoryInterface;

class VehicleTypeController extends Controller
{
    private $vehicleTypeRepository;
    public function __construct(VehicleTypeRepositoryInterface $vehicleTypeRepository)
    {
        $this->vehicleTypeRepository = $vehicleTypeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->vehicleTypeRepository->getVehicleTypes($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->vehicleTypeRepository->createVehicleType($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->vehicleTypeRepository->getVehicleType($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->vehicleTypeRepository->updateVehicleType($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->vehicleTypeRepository->deleteVehicleType($id);
    }
}
