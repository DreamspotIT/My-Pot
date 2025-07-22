<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // ✅ View Single User by ID
    public function viewUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    // ✅ List All Users
    public function listUsers()
    {
        return response()->json(User::all());
    }

    // ✅ Delete User by ID
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
