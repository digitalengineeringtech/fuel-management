<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nozzle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dispenser(): BelongsTo
    {
        return $this->belongsTo(Dispenser::class);
    }

    public function stockPrice(): BelongsTo
    {
        return $this->belongsTo(StockPrice::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
