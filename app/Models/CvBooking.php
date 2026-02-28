<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvBooking extends Model
{
	protected $connection = 'system';
	protected $table = 'cv_bookings';

	protected $fillable = ['cv_id','office_id','end_user_id','status','note'];

	public function endUser()
	{
		return $this->belongsTo(\App\Models\Identity\EndUser::class, 'end_user_id', 'id');
	}

	public function cv()
	{
		return $this->belongsTo(Cv::class, 'cv_id', 'id');
	}
}


