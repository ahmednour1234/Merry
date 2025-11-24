<?php

namespace App\Models\Identity;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class IdentityPersonalAccessToken extends SanctumPersonalAccessToken
{
    protected $connection = 'identity';
    protected $table = 'personal_access_tokens';
}

