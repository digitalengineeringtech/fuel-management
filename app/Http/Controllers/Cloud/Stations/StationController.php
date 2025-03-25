<?php

namespace App\Http\Controllers\Cloud\Stations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\Stations\CreateRequest;
use App\Http\Requests\Cloud\Stations\UpdateRequest;
use App\Http\Resources\Cloud\Stations\StationResource;
use App\Repositories\Cloud\Contracts\Stations\StationRepositoryInterface;
use Illuminate\Http\Request;

class StationController extends Controller
{
    private StationRepositoryInterface $stationRepository;

    public function __construct(StationRepositoryInterface $stationRepository)
    {
        $this->stationRepository = $stationRepository;
    }

    /**
     * All Stations
     *
     * @response array{message: string, code: int, data: StationResource[]}
     */
    public function index(Request $request)
    {
        return $this->stationRepository->getStations($request);
    }

    /**
     * Create Station
     *
     * @response array{message: string, code: int, data: StationResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->stationRepository->createStation($request->validated());
    }

    /**
     * Single Station
     *
     * @response array{message: string, code: int, data: StationResource}
     */
    public function show($id)
    {
        return $this->stationRepository->getStation($id);
    }

    /**
     * Update Station
     *
     * @response array{message: string, code: int, data: StationResource}
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->stationRepository->updateStation($id, $request->validated());
    }

    /**
     * Delete Station
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy($id)
    {
        return $this->stationRepository->deleteStation($id);
    }
}
