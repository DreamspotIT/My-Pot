<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoldDiscount extends Model
{
    use HasFactory;

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
