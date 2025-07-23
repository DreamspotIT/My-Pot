<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\User;
use App\Models\Api\OtpVerification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // ✅ REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'firstname'  => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname'   => 'required|string|max:255',
            'email'      => 'required|email|unique:users',
            'phone'      => 'required|unique:users',
            'password'   => 'required|min:6',
            'gender'     => 'nullable|in:male,female,other',
        ]);

        $user = User::create([
            'firstname'         => $request->firstname,
            'middlename'        => $request->middlename,
            'lastname'          => $request->lastname,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'gender'            => $request->gender ?? null,
            'password'          => bcrypt($request->password),
            'original_password' => $request->password, // ✅ plain password
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ]);

        $otp = rand(100000, 999999);

        OtpVerification::create([
            'user_id'   => $user->id,
            'otp_code'  => $otp,
            'verified'  => 0,
            'expiresAt' => now()->addMinutes(10), // ✅ expires in 10 mins
        ]);

        return response()->json([
            'message' => 'OTP Sent Successfully',
            'otp'     => $otp,
            'user_id' => $user->id
        ]);
    }

    // ✅ VERIFY OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'user_id'  => 'required|exists:users,id',
            'otp_code' => 'required',
        ]);

        $otp = OtpVerification::where('user_id', $request->user_id)
            ->where('otp_code', $request->otp_code)
            ->where('verified', 0)
            ->where('expiresAt', '>=', now())
            ->first();

        if (!$otp) {
            return response()->json(['error' => 'Invalid or expired OTP'], 401);
        }

        $otp->update(['verified' => 1]);
        $otp->user->update(['is_verified' => 1]);

        $token = $otp->user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'OTP Verified Successfully',
            'token'   => $token,
            'user'    => $otp->user
        ]);
    }

    // ✅ LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password'   => 'required',
        ]);

        $user = User::where('email', $request->identifier)
                    ->orWhere('phone', $request->identifier)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        if (!$user->is_verified) {
            return response()->json(['error' => 'Account not verified'], 403);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login Successful',
            'token'   => $token,
            'user'    => $user,
        ]);
    }

    // ✅ UPDATE USER
    public function updateUser(Request $request)
    {
        $request->validate([
            'firstname'  => 'nullable|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname'   => 'nullable|string|max:255',
            'email'      => 'nullable|email|unique:users,email,' . $request->user()->id,
            'phone'      => 'nullable|string|unique:users,phone,' . $request->user()->id,
            'gender'     => 'nullable|in:male,female,other',
        ]);

        $user = $request->user();

        $user->update([
            'firstname'  => $request->firstname ?? $user->firstname,
            'middlename' => $request->middlename ?? $user->middlename,
            'lastname'   => $request->lastname ?? $user->lastname,
            'email'      => $request->email ?? $user->email,
            'phone'      => $request->phone ?? $user->phone,
            'gender'     => $request->gender ?? $user->gender,
        ]);

        return response()->json([
            'message' => 'User updated successfully',
            'user'    => $user
        ]);
    }

    // ✅ DELETE USER
    public function deleteUser(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    // ✅ DASHBOARD
    public function dashboard()
    {
        return response()->json(['message' => 'Welcome to MY Pot Digi-Gold Dashboard']);
    }

    // ✅ LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
