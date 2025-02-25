<?php

namespace App\Http\Controllers\Cloud\FuelTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\FuelTypes\CreateRequest;
use App\Http\Requests\Cloud\FuelTypes\UpdateRequest;
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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->fuelTypeRepository->getFuelTypes($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->fuelTypeRepository->createFuelType($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->fuelTypeRepository->getFuelType($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->fuelTypeRepository->updateFuelType($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->fuelTypeRepository->deleteFuelType($id);
    }
}
