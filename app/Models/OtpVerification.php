<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class OtpVerification extends Model
{
    protected $table = 'otp_verifications';

    protected $fillable = [
        'user_id',
        'otp_code',
        'expiresAt',
        'verified',
        'createdAt',
        'updatedAt',
    ];

    public $timestamps = false;

    // Optional: relation to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
