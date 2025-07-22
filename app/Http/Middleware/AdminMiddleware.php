<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\User; // ✅ Adjust namespace if using Models\Api
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ✅ List All Users with full name composed
    public function listUsers()
    {
        $users = User::all()->map(function ($user) {
            return [
                'id'         => $user->id,
                'firstname'  => $user->firstname,
                'middlename' => $user->middlename,
                'lastname'   => $user->lastname,
                'fullname'   => trim("{$user->firstname} {$user->middlename} {$user->lastname}"),
                'email'      => $user->email,
                'phone'      => $user->phone,
                'gender'     => $user->gender,
                'role'       => $user->role,
                'created_at' => $user->created_at,
            ];
        });

        return response()->json($users);
    }

    // ✅ Delete User by ID with role check
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user->role === 'admin') {
            return response()->json(['error' => 'Cannot delete another admin'], 403);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
