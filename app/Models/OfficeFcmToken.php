<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeFcmToken extends Model
{
    protected $connection = 'system';
    protected $table = 'office_fcm_tokens';
    protected $fillable = ['office_id','token','device','platform'];
}
