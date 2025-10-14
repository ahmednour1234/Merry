<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $connection = 'system';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id','name','slug','owner_email','timezone','features'];

    protected $casts = [
        'features' => 'array',
    ];

    public function domains()
    {
        return $this->hasMany(TenantDomain::class, 'tenant_id', 'id');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'tenant_language', 'tenant_id', 'language_code')
                    ->withPivot('is_default');
    }
}
