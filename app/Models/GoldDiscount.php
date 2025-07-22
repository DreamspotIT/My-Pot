<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoldDiscount extends Model
{
    protected $fillable = [
        'name',
        'percentage',
        'code',
        'min_purchase',
        'start_date',
        'end_date',
        'description',
        'is_active',
    ];
}
