<?php

namespace App\Http\Controllers\Cloud\FuelTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\FuelTypes\CreateRequest;
use App\Http\Requests\Cloud\FuelTypes\UpdateRequest;
use App\Http\Resources\Cloud\FuelTypes\FuelTypeResource;
use App\Repositories\Cloud\Contracts\FuelTypes\FuelTypeRepositoryInterface;
use Illuminate\Http\Request;

class FuelTypeController extends Controller
{
    private $fuelTypeRepository;

    public function __construct(FuelTypeRepositoryInterface $fuelTypeRepository)
    {
        $this->fuelTypeRepository = $fuelTypeRepository;
    }

    /**
     * All Fuel Types
     *
     * @response array{message: string, code: int, data: FuelTypeResource[]}
     */
    public function index(Request $request)
    {
        return $this->fuelTypeRepository->getFuelTypes($request);
    }

    /**
     * Create Fuel Type
     *
     * @response array{message: string, code: int, data: FuelTypeResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->fuelTypeRepository->createFuelType($request->validated());
    }

    /**
     * Single Fuel Type
     *
     * @response array{message: string, code: int, data: FuelTypeResource}
     */
    public function show($id)
    {
        return $this->fuelTypeRepository->getFuelType($id);
    }

    /**
     * Update Fuel Type
     *
     * @response array{message: string, code: int, data: FuelTypeResource}
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->fuelTypeRepository->updateFuelType($id, $request->validated());
    }

    /**
     * Delete Fuel Type
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy($id)
    {
        return $this->fuelTypeRepository->deleteFuelType($id);
    }
}
