<?php

namespace App\Http\Controllers\Local\Nozzles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Nozzles\CreateRequest;
use App\Http\Requests\Local\Nozzles\UpdateRequest;
use App\Repositories\Local\Contracts\Nozzles\NozzleRepositoryInterface;
use Illuminate\Http\Request;

class NozzleController extends Controller
{
    public NozzleRepositoryInterface $nozzleRepository;

    public function __construct(NozzleRepositoryInterface $nozzleRepository)
    {
        $this->nozzleRepository = $nozzleRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->nozzleRepository->getNozzles($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->nozzleRepository->createNozzle($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->nozzleRepository->getNozzle($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $this->nozzleRepository->updateNozzle($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->nozzleRepository->deleteNozzle($id);
    }
}
