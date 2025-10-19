<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    protected $connection = 'system';
    protected $table = 'city_translations';

    protected $fillable = ['city_id','lang_code','name'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
