<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditLog extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    public $timestamps = false; // عندنا created_at فقط
    protected $fillable = ['tenant_id','user_id','action','model','model_id','request','changes','ip','ua','active','created_at'];
    protected $casts = ['request' => 'array', 'changes' => 'array', 'active' => 'boolean', 'created_at' => 'datetime'];
}
