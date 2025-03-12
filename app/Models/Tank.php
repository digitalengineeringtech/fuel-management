<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tank extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    public function fuelIns(): HasMany
    {
        return $this->hasMany(FuelIn::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
