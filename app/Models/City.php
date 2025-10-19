<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'cities';

    protected $fillable = ['slug','country_code','active'];
    protected $casts = ['active' => 'boolean'];

    public function translations()
    {
        return $this->hasMany(CityTranslation::class, 'city_id');
    }

    public function scopeActive($q, $active = true)
    {
        return $q->where('active', (bool) $active);
    }
}
