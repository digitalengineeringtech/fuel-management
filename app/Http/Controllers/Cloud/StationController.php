<?php

namespace App\Http\Controllers\Cloud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\Stations\CreateRequest;
use App\Http\Requests\Cloud\Stations\UpdateRequest;
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
    public function store(CreateRequest $request)
    {
        return $this->stationRepository->createStation($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->stationRepository->getStation($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->stationRepository->updateStation($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->stationRepository->deleteStation($id);
    }
}
