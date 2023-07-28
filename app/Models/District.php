<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Province;
use App\Models\Ward;

class District extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    // ========== DISTRICT RELATIONSHIP ========== //
    // 1 district chỉ thuộc về 1 province
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    // 1 district có thể có nhiều phường
    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
}
