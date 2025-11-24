<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLanguage extends Model
{
    protected $connection = 'system';
    protected $table = 'system_languages';

    protected $fillable = [
        'code', 'name', 'native_name', 'rtl', 'status', 'meta',
    ];

    protected $casts = [
        'rtl'  => 'boolean',
        'meta' => 'array',
    ];

    // Scopes مفيدة
    public function scopeActive($q)   { return $q->where('status', 'active'); }
    public function scopeInactive($q) { return $q->where('status', 'inactive'); }
}
