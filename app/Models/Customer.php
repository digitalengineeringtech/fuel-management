<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\Customer> */
    use HasFactory;

    protected $guarded = [];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function member()
    {
        return $this->hasOne(Member::class);
    }
}
