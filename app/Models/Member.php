<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\Member> */
    use HasFactory;

    protected $guarded = [];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
