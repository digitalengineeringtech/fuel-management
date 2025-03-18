<?php

namespace App\Http\Controllers\Local\Tanks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Tanks\CreateRequest;
use App\Http\Requests\Local\Tanks\UpdateRequest;
use App\Repositories\Local\Contracts\Tanks\TankRepositoryInterface;
use Illuminate\Http\Request;

class TankController extends Controller
{
    private TankRepositoryInterface $tankRepository;

    public function __construct(TankRepositoryInterface $tankRepository)
    {
        $this->tankRepository = $tankRepository;
    }

    public function index(Request $request)
    {
        return $this->tankRepository->getTanks($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->tankRepository->createTank($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->tankRepository->getTank($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $this->tankRepository->updateTank($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->tankRepository->deleteTank($id);
    }
}
