<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
    public function index()
    {
        return view('content.authentications.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginValue = $request->input('email');
        $password = $request->input('password');

        // Get user by email
        $user = User::where('email', $loginValue)->first();

        if ($user && Hash::check($password, $user->password)) {
            // ✅ Use Laravel Auth system
            Auth::login($user);

            // Optional: Store extras in session if needed
                Session::put('name', $user->name);   // ← this was missing!

            Session::put('role', $user->role);

            // ✅ Redirect based on role
            return redirect()->route('dashboard-analytics');
        } else {
            return back()->withErrors(['login_error' => 'Invalid credentials'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();       // ✅ Laravel logout
        Session::flush();     // Optional: clear extra session data
        return redirect()->route('auth-index');
    }
}
