<?php

namespace App\Traits;

use Exception;
use Carbon\Carbon;
use App\Models\Sale;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

trait HasSale
{
    public function createSale(array $attributes)
    {
        $previousSale = Sale::where('nozzle_id', $attributes['nozzle_id'])
                            ->latest('id')
                            ->first();

        $data = array_merge($attributes, [
            'totalizer_liter' => $previousSale ? $previousSale->totalizer_liter : 0,
            'totalizer_amount' => $previousSale ? $previousSale->totalizer_amount : 0
        ]);


        $existedSale = $this->checkCachedSaleExist($attributes['nozzle_id']);

        if($existedSale) {
            Redis::delete('sale');

            return;
        }

        $sale = Sale::create($data);

        Redis::set('sale', json_encode($sale));

        return $sale;
    }

    public function updateSale(array $cachedSale, array $messages)
    {
        $previousSale = Sale::where('id', '!=', $cachedSale['id'])
                            ->where('nozzle_id', $cachedSale['nozzle_id'])
                            ->where('dispenser_id', $cachedSale['dispenser_id'])
                            ->latest('id')
                            ->first();

        $data = [
            'sale_price' => $messages[1],
            'sale_liter' => $messages[2],
            'total_price' => $messages[3],
            'totalizer_liter' => $previousSale ? ($previousSale->totalizer_liter + $messages[2]) : $messages[2],
            'totalizer_amount' => $previousSale ? ($previousSale->totalizer_amount + $messages[3]) : $messages[3],
            'device_totalizer_liter' => $messages[4],
            'device_totalizer_amount' => $messages[5]
        ];

        $updatedSale = Sale::where('id', $cachedSale['id'])
                            ->update($data);

        Redis::delete('sale');

        return $updatedSale;
    }

    public function checkCachedSaleExist($nozzleId)
    {
        $redis = Redis::get('sale');

        $cachedSale = json_decode($redis, true);

        if($cachedSale != null && $cachedSale['nozzle_id'] == $nozzleId) {
            return true;
        } else {
            return false;
        }
    }

    public function generateVoucherNo($stationId, $nozzleId, $cashier)
    {
        $today = Carbon::today()->format('Ymd'); // Get current date

        $latestVoucher = DB::table('sales')
            ->where('nozzle_id', $nozzleId)
            ->latest('id')
            ->value('voucher_no');

        // Extract last counter if available
        if ($latestVoucher) {
            $parts = explode('/', $latestVoucher);
            $lastCounter = (int) end($parts); // Get last counter
            $counter = $lastCounter + 1;
        } else {
            $counter = 1; // Start from 1 if no record for today
        }

        // Generate new voucher number
        $voucherNo = "{$stationNo}/".Str::upper($cashier)."/".$today."/{$counter}";

        return $voucherNo;
    }

    public function getPresetAmount($type, $amount): string
    {
        if($type == 'kyat') {
            if (!empty($amount) && strlen($amount) > 6) {
                throw new Exception("You can enter only 6 digits");
            }

            if (!empty($amount)) {
                $amount = str_pad($amount, 7, "0", STR_PAD_LEFT);

                return 'P' . $amount;
            }
        } else {
            if (!empty($amount) && strlen($amount) > 7) {
                throw new Exception("You can enter only 6 digits");
            }

            if (!empty($amount)) {
                $arr = explode(".", $amount);

                if (strlen($arr[0]) > 3 || (isset($arr[1]) && strlen($arr[1]) > 3) || !isset($arr[1])) {
                    throw new Exception("The number format is 999.999");
                }

                $newLiter = str_pad($arr[0], 4, "0", STR_PAD_LEFT) .
                            (isset($arr[1]) ? str_pad($arr[1], 3, "0", STR_PAD_RIGHT) : "000");

                return 'L' . $newLiter;
            }
        }
    }
}
