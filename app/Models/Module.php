<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $connection = 'system';
    protected $table = 'modules';

    protected $fillable = ['name','namespace','provider','path','enabled','meta'];
    protected $casts = ['enabled' => 'boolean','meta' => 'array'];
}
