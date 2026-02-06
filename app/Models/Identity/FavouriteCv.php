<?php

namespace App\Models\Identity;

use Illuminate\Database\Eloquent\Model;

class FavouriteCv extends Model
{
	protected $connection = 'identity';
	protected $table = 'favourites_cv';

	protected $fillable = ['end_user_id','cv_id'];
}


