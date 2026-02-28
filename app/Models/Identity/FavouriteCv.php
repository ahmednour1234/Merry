<?php

namespace App\Models\Identity;

use Illuminate\Database\Eloquent\Model;

class FavouriteCv extends Model
{
	protected $connection = 'identity';
	protected $table = 'favourites_cv';

	protected $fillable = ['end_user_id','cv_id'];

	public function endUser()
	{
		return $this->belongsTo(EndUser::class, 'end_user_id', 'id');
	}

	public function cv()
	{
		return $this->belongsTo(\App\Models\Cv::class, 'cv_id', 'id');
	}
}


