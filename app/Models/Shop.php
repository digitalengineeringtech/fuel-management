<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    /** @use HasFactory<\Database\Factories\Shop> */
    use HasFactory;

    protected $guarded = [];

    public function stations(): HasMany
    {
        return $this->hasMany(Station::class);
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image'] == null) {
            return asset('images/six-kendra.jpg');
        }

        return asset('storage/'.$this->attributes['image']);
    }
}
