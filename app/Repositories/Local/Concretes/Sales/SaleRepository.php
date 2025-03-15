<?php

namespace App\Repositories\Local\Concretes\Sales;

use Exception;
use App\Models\Sale;
use App\Traits\HasSale;
use App\Jobs\ProcessPreset;
use App\Traits\HasResponse;
use App\Http\Resources\Local\Sales\SaleResource;
use App\Repositories\Local\Contracts\Sales\SaleRepositoryInterface;

class SaleRepository implements SaleRepositoryInterface
{
    use HasResponse;

    use HasSale;

    public function getSales($request)
    {
        try {
            $sales = Sale::paginate(10);

            return SaleResource::collection($sales);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getSale($id)
    {
        try {
            $sale = Sale::find($id);

            return new SaleResource($sale);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createSale($data)
    {
        try {
            $voucherNo = $this->generateVoucherNo($data['station_id'], $data['nozzle_id'], $data['cashier_code']);

            $sale = $this->createSale([
                ...$data,
                'voucher_no' => $voucherNo,
                'cashier_code' => $cashier
            ]);

            if (! $sale) {
                return $this->errorResponse('Failed to create sale', 400, null);
            }

            return $this->successResponse('Sale created successfully', 201, new SaleResource($sale));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateSale($id, $data)
    {
        try {
            $sale = Sale::find($id);

            if (! $sale) {
                return $this->errorResponse('Sale not found', 404, null);
            }

            $sale->update($data);

            return $this->successResponse('Sale updated successfully', 200, new SaleResource($sale));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteSale($id)
    {
        try {
            $sale = Sale::find($id);

            if (! $sale) {
                return $this->errorResponse('Sale not found', 404, null);
            }

            $sale->delete();

            return $this->successResponse('Sale deleted successfully', 200, null);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function presetSale($type = 'kyat', $data)
    {
         try {
            ProcessPreset::dispatch($type, $data);

            return $this->successResponse('Preset sale created successfully', 201, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }

    }

    public function cashierSale($data)
    {
        try {
            $voucherNo = $this->generateVoucherNo($data['station_id'], $data['nozzle_id'], $data['cashier_code']);

            $sale = $this->createSale([
                ...$data,
                'voucher_no' => $voucherNo,
                'cashier_code' => $cashier
            ]);

            if (! $sale) {
                return $this->errorResponse('Failed to create sale', 400, null);
            }

            return $this->successResponse('Sale created successfully', 201, new SaleResource($sale));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
