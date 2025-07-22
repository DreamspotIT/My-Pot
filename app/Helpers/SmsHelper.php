<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsHelper
{
public static function sendOtp($phone, $otp)
{
    try {
        $response = Http::withHeaders([
            'authorization' => 'hGFaqPd307xIQOcWFZUzMKDHVD8VsZNiHbjvbv4oTv08NK2wGdNW34gNkREc',
        ])->post('https://www.fast2sms.com/dev/bulkV2', [
            'route'    => 'q', // ✅ CHANGE THIS from 'otp' to 'q'
            'message'  => "Your OTP is $otp", // ✅ plain message
            'language' => 'english',
            'flash'    => 0,
            'numbers'  => $phone,
        ]);

        \Log::info('Fast2SMS Response', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);
    } catch (\Exception $e) {
        \Log::error('SMS Send Failed: ' . $e->getMessage());
    }
}

}