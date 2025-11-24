<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'plans';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'code','name','description','base_currency','base_price','billing_cycle','active','meta'
    ];

    protected $casts = [
        'active' => 'boolean',
        'base_price' => 'decimal:2',
        'meta' => 'array',
    ];

    public function translations() { return $this->hasMany(PlanTranslation::class, 'plan_code', 'code'); }
    public function features()     { return $this->hasMany(PlanFeature::class, 'plan_code', 'code'); }
}
