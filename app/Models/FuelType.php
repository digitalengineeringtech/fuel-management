<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FuelType extends Model
{
    protected $guarded = [];

    public function stockPrice(): HasOne
    {
        return $this->hasOne(StockPrice::class);
    }
}
