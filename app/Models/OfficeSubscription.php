<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeSubscription extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'office_subscriptions';

    protected $fillable = [
        'office_id','plan_code','status','auto_renew','starts_at','ends_at',
        'currency_code','price','meta','active'
    ];

    protected $casts = [
        'auto_renew' => 'boolean',
        'active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'price' => 'decimal:2',
        'meta' => 'array',
    ];

    public function plan(){ return $this->belongsTo(Plan::class, 'plan_code', 'code'); }
    public function office(){ return $this->belongsTo(Office::class); }
}
