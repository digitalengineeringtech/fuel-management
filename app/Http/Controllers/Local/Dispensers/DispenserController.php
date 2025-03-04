<?php

namespace App\Http\Controllers\Local\Dispensers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Dispensers\CreateRequest;
use App\Http\Requests\Local\Dispensers\UpdateRequest;
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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->dispenserRepository->getDispensers($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->dispenserRepository->createDispenser($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->dispenserRepository->getDispenser($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $this->dispenserRepository->updateDispenser($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->dispenserRepository->deleteDispenser($id);
    }
}
