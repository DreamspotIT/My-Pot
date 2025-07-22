<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $adminEmail = 'admin@digigoldapp.com';
        $adminName = 'DigiGoldAdmin';
        $strongPassword = 'DG@dm1n#2025!'; // Strong password

        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'name'              => $adminName,
                'email'             => $adminEmail,
                'phone'             => '9000000001',
                'gender'            => 'male',
                'password'          => Hash::make($strongPassword),
                'original_password' => $strongPassword, // ⚠️ Not secure for production
                'is_verified'       => 1,
                'role'              => 'admin',
            ]);
        }
    }
}
