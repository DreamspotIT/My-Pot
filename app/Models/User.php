<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'phone', 'gender', 'password',     'original_password',
'is_verified', 'role'
    ];

    protected $hidden = ['password'];

    public $timestamps = false;

    protected $casts = [
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
        'is_verified' => 'boolean'
    ];
}
