<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $adminEmail = 'admin@potgoldapp.com';
        $strongPassword = 'PG@dm1n#2025!'; // Strong password

        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'firstname'         => 'Pot',
                'middlename'        => 'Gold',
                'lastname'          => 'Admin',
                'email'             => $adminEmail,
                'phone'             => '9023098767',
                'gender'            => 'male',
                'password'          => Hash::make($strongPassword),
                'original_password' => $strongPassword, // ⚠️ Not secure for production
                'is_verified'       => 1,
                'role'              => 'admin',
            ]);
        }
    }
}
