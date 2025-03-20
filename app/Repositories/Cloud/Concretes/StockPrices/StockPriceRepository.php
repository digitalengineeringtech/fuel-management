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
        try {
            $stockPrices = StockPrice::paginate(10);

            if (! $stockPrices) {
                return $this->errorResponse('StockPrice not found', 404, null);
            }

            return $this->successResponse('StockPrice successfully retrieved', 200, StockPriceResource::collection($stockPrices));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getStockPrice($id)
    {
        try {
            $stockPrice = StockPrice::find($id);

            if (! $stockPrice) {
                return $this->errorResponse('StockPrice not found', 404, null);
            }

            return $this->successResponse('StockPrice successfully retrieved', 200, new StockPriceResource($stockPrice));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createStockPrice($data)
    {
        try {

            // Create a new stockPrice
            $stockPrice = StockPrice::create($data);

            if (! $stockPrice) {
                return $this->errorResponse('StockPrice not found', 404, null);
            }

            return $this->successResponse('StockPrice successfully created', 201, new StockPriceResource($stockPrice));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateStockPrice($id, $data)
    {
        try {
            // find the stockPrice by id
            $stockPrice = StockPrice::find($id);

            // if the stockPrice doesn't exist, return an error response
            if (! $stockPrice) {
                return $this->errorResponse('StockPrice not found', 404, null);
            }

            // update the stockPrice
            $stockPrice->update($data);

            return $this->successResponse('StockPrice successfully updated', 200, new StockPriceResource($stockPrice));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteStockPrice($id)
    {
        try {
            // find the stockPrice by id
            $stockPrice = StockPrice::find($id);

            // if the stockPrice doesn't exist, return an error response
            if (! $stockPrice) {
                return $this->errorResponse('StockPrice not found', 404, null);
            }

            // Delete the stockPrice's database
            $stockPrice->delete();

            return $this->successResponse('StockPrice successfully deleted', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
