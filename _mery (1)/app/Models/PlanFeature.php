<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    protected $connection = 'system';
    protected $table = 'plan_features';
    protected $fillable = ['plan_code','feature_key','limit','value','active'];

    protected $casts = [
        'limit' => 'integer',
        'active' => 'boolean',
        'value' => 'array',
    ];
}
