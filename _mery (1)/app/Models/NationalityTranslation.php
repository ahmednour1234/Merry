<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NationalityTranslation extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'nationality_translations';

    protected $fillable = ['nationality_id','lang_code','name'];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

}
