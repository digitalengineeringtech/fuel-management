<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait HasGenerate
{
    public function generateShopNumber(string $name)
    {
        $words = preg_split('/(?=[A-Z])|\s+/', trim($name), -1, PREG_SPLIT_NO_EMPTY);

        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper($word[0]);
        }

        return $initials;
    }

    public function generateStationNumber(int $shopId)
    {
        $shop = DB::table('shops')->where('id', $shopId)->first();

        $station = DB::table('stations')->where('shop_id', $shopId)->count();

        if ($station != 0) {
            return $shop->code.'-'. sprintf('%03d', $station + 1);
        }

        return $shop->code.'-'. sprintf('%03d', 1);
    }

    public function generateDatabaseName(string $stationNo)
    {
        return 'station_'.Str::lower(Str::replace('-', '_', $stationNo)).'_'.Str::random(5);
    }

    public function generateCashierCode(string $role, int $stationId)
    {
        $station = DB::table('stations')->where('id', $stationId)->first();

        $user = DB::table('users')->where('station_id', $stationId)->count();

        switch($role) {
            case 'manager':
                return $user != 0 ? 'M-' . $station->station_no . '-' . $user + 1 : 'M-' . $station->station_no . '-' . 1;
                break;
            case 'cashier':
                return $user != 0 ? 'C-' . $station->station_no . '-' . $user + 1 : 'C-' . $station->station_no . '-' . 1;
                break;
            default:
                break;
        }
    }

    public function generateFuelInCode() {}
}
