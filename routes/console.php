<?php

use App\Models\Identity\EndUser;
use App\Models\SystemPersonalAccessToken;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('sanctum:setup-enduser-tokens', function () {
    $this->info('Ensuring identity personal access tokens table exists...');

    if (! Schema::connection('identity')->hasTable('personal_access_tokens')) {
        $this->comment('Running identity migrations so the table can be created.');
        Artisan::call('migrate', [
            '--path' => 'database/migrations/identity',
            '--force' => true,
        ]);
        $this->line(Artisan::output());

        if (! Schema::connection('identity')->hasTable('personal_access_tokens')) {
            $this->error('Unable to create identity personal_access_tokens table. See output above.');
            return;
        }
    } else {
        $this->info('Identity personal_access_tokens table already exists.');
    }

    $pending = SystemPersonalAccessToken::query()
        ->where('tokenable_type', EndUser::class)
        ->count();

    if ($pending === 0) {
        $this->info('There are no end-user tokens stored on the system connection.');
        return;
    }

    $this->comment("Migrating {$pending} end-user tokens to the identity connection...");

    $migrated = 0;
    $skipped = 0;

    SystemPersonalAccessToken::query()
        ->where('tokenable_type', EndUser::class)
        ->orderBy('id')
        ->chunkById(500, function ($tokens) use (&$migrated, &$skipped) {
            foreach ($tokens as $token) {
                $exists = DB::connection('identity')
                    ->table('personal_access_tokens')
                    ->where('id', $token->id)
                    ->exists();

                if ($exists) {
                    $skipped++;
                    continue;
                }

                $abilities = $token->getOriginal('abilities');

                DB::connection('identity')
                    ->table('personal_access_tokens')
                    ->insert([
                        'id' => $token->id,
                        'tokenable_type' => $token->tokenable_type,
                        'tokenable_id' => $token->tokenable_id,
                        'name' => $token->name,
                        'token' => $token->token,
                        'abilities' => is_array($abilities) ? json_encode($abilities) : $abilities,
                        'last_used_at' => $token->last_used_at,
                        'expires_at' => $token->expires_at,
                        'created_at' => $token->created_at,
                        'updated_at' => $token->updated_at,
                    ]);

                $token->delete();
                $migrated++;
            }
        });

    $this->info("Migrated {$migrated} token(s). Skipped {$skipped} already present.");
})->purpose('Ensure Sanctum end-user tokens live on the identity connection.');
