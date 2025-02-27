<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\Customer> */
    use HasFactory;

    protected $guarded = [];

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function member(): HasOne
    {
        return $this->hasOne(Member::class);
    }
}
