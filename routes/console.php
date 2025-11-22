<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\User;
use App\Models\Permission;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Grant all permissions to a user (default user_id=1)
| Usage: php artisan perms:grant-all-to-user {userId?}
|--------------------------------------------------------------------------
*/
Artisan::command('perms:grant-all-to-user {userId=1}', function (int $userId = 1) {
    /** @var \App\Models\User|null $user */
    $user = User::on('system')->find($userId);
    if (!$user) {
        $this->error("User {$userId} not found on 'system' connection.");
        return;
    }

    $permIds = Permission::on('system')->where('active', true)->pluck('id')->all();
    if (empty($permIds)) {
        $this->info('No active permissions found.');
        return;
    }

    // Insert without removing existing rows, and without duplicates
    $user->permissions()->syncWithoutDetaching($permIds);

    $this->info("Granted " . count($permIds) . " permissions to user {$userId}.");
})->purpose('Grant all active permissions to the specified user on the system DB');

// Schedule: run hourly for user_id=1. Ensure your OS cron runs `php artisan schedule:run` each minute.
Schedule::command('perms:grant-all-to-user 1')->hourly();
