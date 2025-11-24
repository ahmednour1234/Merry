<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanTranslation extends Model
{
    protected $connection = 'system';
    protected $table = 'plan_translations';
    protected $fillable = ['plan_code','lang_code','name','description'];
}
