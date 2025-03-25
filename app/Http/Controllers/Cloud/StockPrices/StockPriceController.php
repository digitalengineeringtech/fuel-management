<?php

namespace App\Http\Controllers\Cloud\StockPrices;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\StockPrices\CreateRequest;
use App\Http\Requests\Cloud\StockPrices\UpdateRequest;
use App\Http\Resources\Cloud\StockPrice\StockPriceResource;
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
     * All Stock Prices
     *
     * @response array{message: string, code: int, data: StockPriceResource[]}
     */
    public function index(Request $request)
    {
        return $this->stockPriceRepository->getStockPrices($request);
    }

    /**
     * Create Stock Price
     *
     * @response array{message: string, code: int, data: StockPriceResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->stockPriceRepository->createStockPrice($request->validated());
    }

    /**
     * Single Stock Price
     *
     * @response array{message: string, code: int, data: StockPriceResource}
     */
    public function show($id)
    {
        return $this->stockPriceRepository->getStockPrice($id);
    }

    /**
     * Update Stock Price
     *
     * @response array{message: string, code: int, data: StockPriceResource}
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->stockPriceRepository->updateStockPrice($id, $request->validated());
    }

    /**
     * Delete Stock Price
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy($id)
    {
        return $this->stockPriceRepository->deleteStockPrice($id);
    }
}
