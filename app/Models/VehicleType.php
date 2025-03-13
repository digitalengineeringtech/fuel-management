<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleType extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleType> */
    use HasFactory;

    protected $guarded = [];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
