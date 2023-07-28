<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'gender',
        'birthday',
        'place_of_birth',
        'ethnicity_code',
        'religion_code',
        'identity_number',
        'candidate_number',
        'country_code',
        'permanent_address',
        'temporary_address',
        'reference_email',
        'reference_phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setNameAttribute($name)
    {
        if (trim($name) === '') return;
        $this->attributes['name'] = mb_convert_case(ucwords(mb_convert_case($name, MB_CASE_LOWER, 'UTF-8')), MB_CASE_TITLE, 'UTF-8');
    }

    public function setPasswordAttribute($password) 
    {
        if (trim($password) === '') return;
        $this->attributes['password'] = Hash::make($password);
    }
}
