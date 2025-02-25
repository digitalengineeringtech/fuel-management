<?php

namespace App\Http\Controllers\Cloud\StockPrices;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\StockPrices\CreateRequest;
use App\Http\Requests\Cloud\StockPrices\UpdateRequest;
use App\Repositories\Cloud\Contracts\StockPrices\StockPriceRepositoryInterface;
use Illuminate\Http\Request;

class StockPriceController extends Controller
{
    private $stockPriceRepository;

    public function __construct(StockPriceRepositoryInterface $stockPriceRepository)
    {
        $this->stockPriceRepository = $stockPriceRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->stockPriceRepository->getStockPrices($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->stockPriceRepository->createStockPrice($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->stockPriceRepository->getStockPrice($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->stockPriceRepository->updateStockPrice($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->stockPriceRepository->deleteStockPrice($id);
    }
}
