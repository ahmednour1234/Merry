<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class TenantDomain extends Model
{
    protected $connection = 'system';
    protected $fillable = ['tenant_id','domain'];
}
