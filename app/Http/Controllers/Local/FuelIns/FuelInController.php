<?php

namespace App\Http\Controllers\Local\FuelIns;

use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Fuelins\CreateRequest;
use App\Http\Requests\Local\Fuelins\UpdateRequest;
use App\Repositories\Local\Contracts\FuelIns\FuelInRepositoryInterface;
use Illuminate\Http\Request;

class FuelInController extends Controller
{

    protected FuelInRepositoryInterface $fuelInRepository;

    public function __construct(FuelInRepositoryInterface $fuelInRepository)
    {
        $this->fuelInRepository = $fuelInRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->fuelInRepository->getFuelIns($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->fuelInRepository->createFuelIn($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->fuelInRepository->getFuelIn($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $this->fuelInRepository->updateFuelIn($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->fuelInRepository->deleteFuelIn($id);
    }
}
