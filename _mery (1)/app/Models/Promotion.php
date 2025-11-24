<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'promotions';
    protected $fillable = [
        'name','plan_code','type','amount','currency_code',
        'starts_at','ends_at','auto_apply','active','meta'
    ];
    protected $casts = [
        'amount' => 'decimal:2',
        'auto_apply' => 'boolean',
        'active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'meta' => 'array',
    ];
}
