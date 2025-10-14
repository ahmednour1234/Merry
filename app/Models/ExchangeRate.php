<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeRate extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $fillable = ['base','quote','rate','fetched_at','active'];
    protected $casts = ['rate' => 'decimal:8', 'active' => 'boolean', 'fetched_at' => 'datetime'];

    public function scopeActive($q){ return $q->where('active', true); }
}
