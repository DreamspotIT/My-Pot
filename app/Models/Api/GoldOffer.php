<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoldOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'discount',
        'start_date',
        'end_date',
    ];
}
