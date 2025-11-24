<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['code','name','symbol','decimal','active'];
    protected $casts = ['active' => 'boolean', 'decimal' => 'integer'];

    public function scopeActive($q){ return $q->where('active', true); }
}
