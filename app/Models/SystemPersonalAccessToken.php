<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class SystemPersonalAccessToken extends SanctumPersonalAccessToken
{
    protected $connection = 'system';                // << المهم
    protected $table = 'personal_access_tokens';
}
