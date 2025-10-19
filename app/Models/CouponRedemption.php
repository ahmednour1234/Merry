<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponRedemption extends Model
{
    protected $connection = 'system';
    protected $table = 'coupon_redemptions';
    protected $fillable = ['coupon_id','office_id','plan_code','discount_value','currency_code'];
    protected $casts = ['discount_value'=>'decimal:2'];
}
