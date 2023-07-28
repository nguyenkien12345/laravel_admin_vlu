<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Admission extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'value_crm'
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

    public function setNameAttribute($name)
    {
        if (trim($name) === '') return;
        $this->attributes['name'] = mb_convert_case(ucwords(mb_convert_case($name, MB_CASE_LOWER, 'UTF-8')), MB_CASE_TITLE, 'UTF-8');
    }

    public function setSlugAttribute($slug)
    {
        if (trim($slug) === '') return;
        $this->attributes['slug'] = Str::slug($slug);
    }
}
