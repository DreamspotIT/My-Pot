<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'otp_code',
        'expiresAt',
        'verified',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
