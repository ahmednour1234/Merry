<?php

namespace App\Models;

use App\Models\Identity\IdentityPersonalAccessToken;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class SystemPersonalAccessToken extends SanctumPersonalAccessToken
{
    protected $connection = 'system';
    protected $table = 'personal_access_tokens';

    public static function findToken($token)
    {
        $tokenModel = parent::findToken($token);

        if ($tokenModel) {
            return $tokenModel;
        }

        return IdentityPersonalAccessToken::findToken($token);
    }
}
