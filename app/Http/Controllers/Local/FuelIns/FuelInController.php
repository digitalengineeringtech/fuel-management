<?php

namespace App\Http\Controllers\Local\FuelIns;

use App\Http\Controllers\Controller;
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
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
