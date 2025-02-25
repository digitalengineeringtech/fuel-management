<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FuelType extends Model
{
    /** @use HasFactory<\Database\Factories\FuelType> */
    use HasFactory;

    protected $guarded = [];

    public function stockPrice(): HasOne
    {
        return $this->hasOne(StockPrice::class);
    }
}
