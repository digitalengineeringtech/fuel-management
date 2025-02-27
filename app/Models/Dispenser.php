<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dispenser extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    public function nozzles(): HasMany
    {
        return $this->hasMany(Nozzle::class);
    }
}
