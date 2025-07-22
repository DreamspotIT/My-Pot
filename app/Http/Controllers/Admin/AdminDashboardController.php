<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Optionally block users
        if (Session::get('role') !== 'admin') {
            return redirect()->route('dashboard-analytics');
        }

        return view('admin.dashboard-analytics');
    }
}
