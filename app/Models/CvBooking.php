<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvBooking extends Model
{
	protected $connection = 'system';
	protected $table = 'cv_bookings';

	protected $fillable = ['cv_id','office_id','end_user_id','status','note'];
}


