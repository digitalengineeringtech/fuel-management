<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\Payment> */
    use HasFactory;

    protected $guarded = [];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image'] == null) {
            return asset('images/six-kendra.jpg');
        }

        return asset('storage/'.$this->attributes['image']);
    }
}
