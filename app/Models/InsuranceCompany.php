<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsuranceCompany extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'insurance_companies';

    protected $fillable = [
        'name','website','logo_path','active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
