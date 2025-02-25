<?php

namespace App\Repositories\Cloud\Concretes\StockPrices;

use App\Http\Resources\Cloud\StockPrice\StockPriceResource;
use App\Models\StockPrice;
use App\Repositories\Cloud\Contracts\StockPrices\StockPriceRepositoryInterface;
use App\Traits\HasResponse;
use Exception;

class StockPriceRepository implements StockPriceRepositoryInterface
{
    use HasResponse;

    public function getStockPrices($request)
    {
        $stock_prices = StockPrice::with('station', 'fuelType')->paginate(10);

        return StockPriceResource::collection($stock_prices);
    }

    public function getStockPrice($id)
    {
        $stock_price = StockPrice::find($id);

        if (! $stock_price) {
            return $this->errorResponse('Stock price not found', 404, null);
        }

        return new StockPriceResource($stock_price);
    }

    public function createStockPrice($data)
    {
        try {

            // Create a new stock price
            $stock_price = StockPrice::create($data);

            return new StockPriceResource($stock_price);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateStockPrice($id, $data)
    {

        // find the stock price by id
        $stock_price = StockPrice::find($id);

        // if the stock price doesn't exist, return an error response
        if (! $stock_price) {
            return $this->errorResponse('Stock price not found', 404, null);
        }

        // update the stock price
        $stock_price->update($data);

        return new StockPriceResource($stock_price);
    }

    public function deleteStockPrice($id)
    {
        // find the stock price by id
        $stock_price = StockPrice::find($id);

        // if the stock price doesn't exist, return an error response
        if (! $stock_price) {
            return $this->errorResponse('Stock price not found', 404, null);
        }

        // Delete the stock price's database
        $stock_price->delete();

        return $this->successResponse('Stock price deleted successfully', 200, null);
    }
}
