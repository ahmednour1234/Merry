<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $connection = 'system';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['code','name','rtl'];
    protected $casts = ['rtl' => 'boolean'];
}
