<?php

namespace App\Repositories\Local\Concretes\Sales;

use App\Http\Resources\Local\Sales\SaleResource;
use App\Models\Sale;
use App\Repositories\Local\Contracts\Sales\SaleRepositoryInterface;
use App\Traits\HasMqtt;
use App\Traits\HasResponse;
use App\Traits\HasSale;
use Exception;

class SaleRepository implements SaleRepositoryInterface
{
    use HasMqtt;
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
                'cashier_code' => $cashier,
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

    public function presetSale($type, $data)
    {
        try {
            $voucherNo = $this->generateVoucherNo($data['station_id'], $data['nozzle_id'], $data['cashier_code']);

            $nozzle = Nozzle::where('id', $data['nozzle_id'])->first();

            $sale = $this->createSale([
                ...$data,
                'voucher_no' => $voucherNo,
                'cashier_code' => $data['cashier_code'],
                'is_preset' => true,
                'preset_amount' => $this->getPresetAmount($type, $data['preset_amount']),
            ]);

            if (! $sale) {
                return $this->errorResponse('Failed to create sale', 400, null);
            }

            $this->getClient()->publish('detpos/local_server/preset', $nozzle->nozzle_no.$type.$data['preset_amount']);

            $this->getClient()->disconnect();

            return $this->successResponse('Sale created successfully', 201, new SaleResource($sale));

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
                'cashier_code' => $data['cashier_code'],
            ]);

            if (! $sale) {
                return $this->errorResponse('Failed to create sale', 400, null);
            }

            $this->getClient()->publish('detpos/local_server/'.$sale->dispenser->dispenser_no, $sale->nozzle->nozzle_no.'D1S1');

            $this->getClient()->disconnect();

            return $this->successResponse('Sale created successfully', 201, new SaleResource($sale));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
