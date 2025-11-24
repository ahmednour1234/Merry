<?php

namespace App\Models;

use App\Models\Identity\IdentityPersonalAccessToken;
use Illuminate\Support\Facades\Log;
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

        try {
            return IdentityPersonalAccessToken::findToken($token);
        } catch (\Throwable $exception) {
            Log::error(
                'Failed to resolve personal access token on identity connection.',
                ['message' => $exception->getMessage()]
            );

            return null;
        }
    }
}
