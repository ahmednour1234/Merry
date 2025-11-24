<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    // استخدم نفس الكونكشن اللي فيه جدول personal_access_tokens
    protected $connection = 'system'; // أو الاسم اللي فيه الجدول فعلاً
}
