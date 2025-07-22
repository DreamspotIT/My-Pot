<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoldOffer extends Model
{
    protected $fillable = ['title', 'description', 'discount', 'start_date', 'end_date'];
}
