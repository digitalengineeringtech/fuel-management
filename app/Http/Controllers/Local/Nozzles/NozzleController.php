<?php

namespace App\Http\Controllers\Local\Nozzles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Nozzles\CreateRequest;
use App\Http\Requests\Local\Nozzles\UpdateRequest;
use App\Http\Resources\Local\Nozzles\NozzleResource;
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
     * All Nozzles
     *
     * @response array{message: string, code: int, data: NozzleResource[]}
     */
    public function index(Request $request)
    {
        return $this->nozzleRepository->getNozzles($request);
    }

    /**
     * Create Nozzle
     *
     * @response array{message: string, code: int, data: NozzleResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->nozzleRepository->createNozzle($request->validated());
    }

    /**
     * Single Nozzle
     *
     * @response array{message: string, code: int, data: NozzleResource}
     */
    public function show(string $id)
    {
        return $this->nozzleRepository->getNozzle($id);
    }

    /**
     * Update Nozzle
     *
     * @response array{message: string, code: int, data: NozzleResource}
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $this->nozzleRepository->updateNozzle($id, $request->validated());
    }

    /**
     * Delete Nozzle
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy(string $id)
    {
        return $this->nozzleRepository->deleteNozzle($id);
    }
}
