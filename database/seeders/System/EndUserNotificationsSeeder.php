<?php

namespace Database\Seeders\System;

use App\Models\Identity\EndUser;
use App\Services\Notifications\NotificationService;
use Illuminate\Database\Seeder;

class EndUserNotificationsSeeder extends Seeder
{
    public function run(): void
    {
        $notificationService = app(NotificationService::class);
        $endUsers = EndUser::where('active', true)->get();

        if ($endUsers->isEmpty()) {
            $this->command?->warn('No active end users found. Skipping notification seeding.');
            return;
        }

        $notification = $notificationService->createNotification([
            'type' => 'system.announcement',
            'title' => 'Welcome to Our Platform',
            'body' => 'Thank you for being part of our community. We are here to serve you better.',
            'data' => ['announcement_id' => 1],
            'priority' => 'normal',
        ]);

        $count = $notificationService->notifyEndUsers($notification, null, ['inapp']);

        $this->command?->info("Created notification for {$count} end user(s).");
    }
}
