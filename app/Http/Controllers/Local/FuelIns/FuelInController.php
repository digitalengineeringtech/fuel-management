<?php

namespace App\Http\Controllers\Local\FuelIns;

use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Fuelins\CreateRequest;
use App\Http\Requests\Local\Fuelins\UpdateRequest;
use App\Http\Resources\Local\FuelIns\FuelInResource;
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
     * All FuelIns
     *
     * @response array{message: string, code: int, data: FuelInResource[]}
     */
    public function index(Request $request)
    {
        return $this->fuelInRepository->getFuelIns($request);
    }

    /**
     * Create FuelIn
     *
     * @response array{message: string, code: int, data: FuelInResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->fuelInRepository->createFuelIn($request->validated());
    }

    /**
     * Single FuelIn
     *
     * @response array{message: string, code: int, data: FuelInResource}
     */
    public function show(string $id)
    {
        return $this->fuelInRepository->getFuelIn($id);
    }

    /**
     * Update FuelIn
     *
     * @response array{message: string, code: int, data: FuelInResource}
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $this->fuelInRepository->updateFuelIn($id, $request->validated());
    }

    /**
     * Delete FuelIn
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy(string $id)
    {
        return $this->fuelInRepository->deleteFuelIn($id);
    }
}
