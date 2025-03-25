<?php

namespace App\Http\Controllers\Local\Dispensers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Dispensers\CreateRequest;
use App\Http\Requests\Local\Dispensers\UpdateRequest;
use App\Http\Resources\Local\Dispensers\DispenserResource;
use App\Repositories\Local\Contracts\Dispensers\DispenserRepositoryInterface;
use Illuminate\Http\Request;

class DispenserController extends Controller
{
    public DispenserRepositoryInterface $dispenserRepository;

    public function __construct(DispenserRepositoryInterface $dispenserRepository)
    {
        $this->dispenserRepository = $dispenserRepository;
    }

    /**
     * All Dispensers
     *
     * @response array{message: string, code: int, data: DispenserResource[]}
     */
    public function index(Request $request)
    {
        return $this->dispenserRepository->getDispensers($request);
    }

    /**
     * Create Dispenser
     *
     * @response array{message: string, code: int, data: DispenserResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->dispenserRepository->createDispenser($request->validated());
    }

    /**
     * Single Dispenser
     *
     * @response array{message: string, code: int, data: DispenserResource}
     */
    public function show(string $id)
    {
        return $this->dispenserRepository->getDispenser($id);
    }

    /**
     * Update Dispenser
     *
     * @response array{message: string, code: int, data: DispenserResource}
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $this->dispenserRepository->updateDispenser($id, $request->validated());
    }

    /**
     * Delete Dispenser
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy(string $id)
    {
        return $this->dispenserRepository->deleteDispenser($id);
    }
}
