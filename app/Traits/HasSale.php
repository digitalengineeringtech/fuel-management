<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait HasSale
{
    public function generateVoucherNo($stationNo, $nozzleId, $cashier)
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
}
