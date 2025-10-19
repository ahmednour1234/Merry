<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Authenticatable
{
    use HasApiTokens, SoftDeletes;

    protected $connection = 'system';
    protected $table = 'offices';
    protected $guard = 'office';

    protected $fillable = [
        'name','commercial_reg_no','city_id','address','phone','email','password',
        'active','blocked','last_login_at','remember_token'
    ];

    protected $hidden = ['password','remember_token'];

    protected $casts = [
        'active' => 'boolean',
        'blocked' => 'boolean',
        'last_login_at' => 'datetime',
    ];
}
