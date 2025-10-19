<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsageCounter extends Model
{
    protected $connection = 'system';
    protected $table = 'usage_counters';
    protected $fillable = ['office_id','feature_key','period_key','used'];
}
