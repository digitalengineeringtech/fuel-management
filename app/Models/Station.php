<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Station extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['shop'];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function stockPrices(): HasMany
    {
        return $this->hasMany(StockPrice::class);
    }

    public function dispensers(): HasMany
    {
        return $this->hasMany(Dispenser::class);
    }

    public function fuelIns(): HasMany
    {
        return $this->hasMany(FuelIn::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function tanks(): HasMany
    {
        return $this->hasMany(Tank::class);
    }
}
