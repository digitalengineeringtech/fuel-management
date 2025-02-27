<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nozzle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dispenser()
    {
        return $this->belongsTo(Dispenser::class);
    }

    public function stockPrice(): BelongsTo
    {
        return $this->belongsTo(StockPrice::class);
    }
}
