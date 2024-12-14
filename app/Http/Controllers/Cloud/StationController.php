<?php

namespace App\Http\Controllers\Cloud;

use App\Http\Controllers\Controller;
use App\Repositories\Cloud\Contracts\Stations\StationRepositoryInterface;
use Illuminate\Http\Request;

class StationController extends Controller
{

    private $stationRepository;
    public function __construct(StationRepositoryInterface $stationRepository)
    {
        $this->stationRepository = $stationRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->stationRepository->getStations($request);
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
