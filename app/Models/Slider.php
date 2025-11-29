<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
	use SoftDeletes;

	protected $connection = 'system';
	protected $table = 'sliders';

	protected $fillable = ['image','link_url','position','active','meta'];
	protected $casts = ['active'=>'boolean','meta'=>'array'];

	public function translations()
	{
		return $this->hasMany(\App\Models\SliderTranslation::class, 'slider_id');
	}
}


