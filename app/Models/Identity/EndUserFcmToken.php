<?php

namespace App\Models\Identity;

use Illuminate\Database\Eloquent\Model;

class EndUserFcmToken extends Model
{
    protected $connection = 'identity';
    protected $table = 'end_user_fcm_tokens';
    protected $fillable = ['end_user_id', 'token', 'device', 'platform'];
}
