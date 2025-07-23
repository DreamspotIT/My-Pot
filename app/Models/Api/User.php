<?php

namespace App\Models\Api;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
      'firstname',
      'middlename',
      'lastname',
      'email',
      'phone',
      'gender',
      'password',
      'original_password', // ✅ add this
      'email_verified_at',
      'is_verified',
      'role',
      'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays (e.g., API responses).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be appended when the model is serialized.
     */
    protected $appends = ['full_name'];

    /**
     * Accessor to get the full name (firstname + middlename + lastname).
     */
    public function getFullNameAttribute()
    {
        return trim("{$this->firstname} {$this->middlename} {$this->lastname}");
    }
}
