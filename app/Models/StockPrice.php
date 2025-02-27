<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockPrice extends Model
{
    /** @use HasFactory<\Database\Factories\StockPrice> */
    use HasFactory;

    // Mass assignment is disabled by default, so we need to explicitly define the fillable fields.
    protected $guarded = [];
    // Always eager load these relationships
    protected $with = ['station', 'fuelType'];

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class);
    }
}
