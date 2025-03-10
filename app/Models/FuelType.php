<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuelType extends Model
{
    /** @use HasFactory<\Database\Factories\FuelType> */
    use HasFactory;

    protected $guarded = [];

    public function stockPrice(): HasOne
    {
        return $this->hasOne(StockPrice::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
