<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
	protected $connection = 'system';
	protected $table = 'slider_translations';

	protected $fillable = ['slider_id','lang_code','title','text'];
}


