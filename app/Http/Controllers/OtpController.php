<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class OtpController extends Controller
{
    public function showForm()
    {
        if (!Session::has('otp_user_id')) {
            return redirect()->route('customer.create'); // Go to customer registration form
        }

        return view('content.pages.verify-otp'); // View where OTP is entered
    }

    public function verify(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $userId = Session::get('otp_user_id');

        $otpRecord = OtpVerification::where('user_id', $userId)
            ->where('otp_code', $request->otp)
            ->where('expiresAt', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        $user = User::find($userId);
        $user->is_verified = 1;
        $user->save();

        $otpRecord->verified = 1;
        $otpRecord->save();

        Session::forget('otp_user_id');

        return redirect()->route('customer.index')->with('success', 'Customer added and verified successfully.');
    }
}