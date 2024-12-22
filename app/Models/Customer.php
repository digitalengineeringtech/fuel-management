<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
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
