<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'coupons';
    protected $fillable = [
        'code','type','amount','currency_code','starts_at','ends_at',
        'max_redemptions','per_office_limit','active','meta'
    ];
    protected $casts = [
        'amount' => 'decimal:2',
        'active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'meta' => 'array',
    ];
}
