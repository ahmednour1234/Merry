<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nationality extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'nationalities';

    protected $fillable = ['code','name','active','meta'];
    protected $casts = ['active'=>'boolean','meta'=>'array'];

    public function translations()
    {
        return $this->hasMany(\App\Models\NationalityTranslation::class, 'nationality_id');
    }

}
