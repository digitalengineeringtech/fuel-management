<?php

namespace App\Http\Controllers\Local\Tanks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Tanks\CreateRequest;
use App\Http\Requests\Local\Tanks\UpdateRequest;
use App\Http\Resources\Local\Tanks\TankResource;
use App\Repositories\Local\Contracts\Tanks\TankRepositoryInterface;

class TankController extends Controller
{
    public TankRepositoryInterface $tankRepository;

    public function __construct(TankRepositoryInterface $tankRepository)
    {
        $this->tankRepository = $tankRepository;
    }

    /**
     * All Tanks
     *
     * @response array{message: string, code: int, data: TankResource[]}
     */
    public function index(Request $request)
    {
        return $this->tankRepository->getTanks($request);
    }

    /**
     * Create Tank
     *
     * @response array{message: string, code: int, data: TankResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->tankRepository->createTank($request->validated());
    }

    /**
     * Single Tank
     *
     * @response array{message: string, code: int, data: TankResource}
     */
    public function show(string $id)
    {
        return $this->tankRepository->getTank($id);
    }

    /**
     * Update Tank
     *
     * @response array{message: string, code: int, data: TankResource}
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $this->tankRepository->updateTank($id, $request->validated());
    }

    /**
     * Delete Tank
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy(string $id)
    {
        return $this->tankRepository->deleteTank($id);
    }
}
