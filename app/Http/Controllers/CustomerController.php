<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OtpVerification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Helpers\SmsHelper;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'firstname'   => 'required|string|max:100',
            'middlename'  => 'nullable|string|max:100',
            'lastname'    => 'required|string|max:100',
            'email'       => 'required|email|unique:users,email',
            'phone'       => 'required|string|unique:users,phone',
            'gender'      => 'required|in:male,female,other',
            'password'    => 'required|min:6|confirmed',
            'role'        => 'required|in:user,customer',
        ]);

        $plainPassword = $request->password;

        // Concatenate full name for 'name' field if you still need it, or remove it if your model has firstname etc.
        $fullName = $request->firstname 
                  . ($request->middlename ? ' ' . $request->middlename : '') 
                  . ' ' . $request->lastname;

        $user = User::create([
            'firstname'         => $request->firstname,
            'middlename'        => $request->middlename,
            'lastname'          => $request->lastname,
            'name'              => $fullName, // optional, remove if not used in DB/model
            'email'             => $request->email,
            'phone'             => $request->phone,
            'gender'            => $request->gender,
            'password'          => Hash::make($plainPassword),
            'original_password' => $plainPassword, // ⚠️ store only if absolutely required
            'is_verified'       => 0,
            'role'              => $request->role,
        ]);

        Auth::login($user);

        $otp = rand(100000, 999999);

        OtpVerification::create([
            'user_id'   => $user->id,
            'otp_code'  => $otp,
            'expiresAt' => Carbon::now()->addMinutes(10),
        ]);

        Mail::raw("Your OTP is: $otp\nPassword: $plainPassword", function ($message) use ($user) {
            $message->to($user->email)->subject('Your OTP & Login Password');
        });

        SmsHelper::sendOtp($user->phone, "OTP: $otp, Password: $plainPassword");

        Session::put('otp_user_id', $user->id);

        return redirect()->route('verify-otp')->with('success', 'OTP and password sent. Please verify.');
    }

    public function index()
    {
        $customers = User::whereIn('role', ['user', 'customer'])->paginate(5);
        return view('content.pages.customer-list', compact('customers'));
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('content.pages.customer-edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname'  => 'required|string|max:100',
            'middlename' => 'nullable|string|max:100',
            'lastname'   => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email,' . $id,
            'phone'      => 'required|string',
            'gender'     => 'required|in:male,female,other',
            'role'       => 'required|in:user,customer'
        ]);

        $customer = User::findOrFail($id);

        $fullName = $request->firstname 
                  . ($request->middlename ? ' ' . $request->middlename : '') 
                  . ' ' . $request->lastname;

        $customer->update([
            'firstname'  => $request->firstname,
            'middlename' => $request->middlename,
            'lastname'   => $request->lastname,
            'name'       => $fullName,  // optional, if you keep the `name` field
            'email'      => $request->email,
            'phone'      => $request->phone,
            'gender'     => $request->gender,
            'role'       => $request->role,
        ]);

        return redirect()->route('customers.list')->with('success', 'Customer updated successfully.');
    }

    public function create()
    {
        return view('content.pages.customer-create');
    }
    public function show($id)
{
    $customer = User::findOrFail($id);
    return view('content.pages.show', compact('customer'));
}

}
