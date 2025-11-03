<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\NotificationRecipient;
use App\Models\User;
use App\Models\Role;
use App\Models\Office;

class FakeNotificationsSeeder extends Seeder
{
    public function run(): void
    {
        // Create a few sample notifications
        $samples = [
            [
                'type' => 'maintenance_announcement',
                'title' => 'Scheduled maintenance tonight',
                'body' => 'We will perform maintenance between 01:00 and 02:00 UTC.',
                'data' => ['window_start' => now()->addDay()->startOfDay()->addHours(1)->toIso8601String()],
                'target' => 'admins',
            ],
            [
                'type' => 'export_completed',
                'title' => 'Export ready: Offices report',
                'body' => 'Your requested export is now available for download.',
                'data' => ['file' => 'offices_report.csv', 'link' => 'https://example.com/download/offices_report.csv'],
                'target' => 'offices',
            ],
        ];

        $adminUsers = User::query()
            ->whereHas('roles', fn($q) => $q->where('slug', 'admin'))
            ->where('active', true)
            ->limit(10)
            ->get(['id','email']);

        $offices = Office::query()->where('active', true)->limit(10)->get(['id','email']);

        $adminRole = Role::query()->where('slug', 'admin')->first();

        foreach ($samples as $sample) {
            $notification = Notification::create([
                'type' => $sample['type'],
                'title' => $sample['title'],
                'body' => $sample['body'],
                'data' => $sample['data'],
                'priority' => 'normal',
                'created_by' => optional($adminUsers->first())->id,
            ]);

            if ($sample['target'] === 'admins') {
                foreach ($adminUsers as $u) {
                    foreach (['inapp','email'] as $channel) {
                        NotificationRecipient::create([
                            'notification_id' => $notification->id,
                            'recipient_type' => 'role',
                            'recipient_id' => $adminRole?->id,
                            'resolved_user_id' => $u->id,
                            'channel' => $channel,
                            'status' => $channel === 'inapp' ? 'sent' : 'queued',
                        ]);
                    }
                }
            } else {
                foreach ($offices as $office) {
                    foreach (['inapp','email'] as $channel) {
                        NotificationRecipient::create([
                            'notification_id' => $notification->id,
                            'recipient_type' => 'office',
                            'recipient_id' => $office->id,
                            'resolved_user_id' => null,
                            'channel' => $channel,
                            'status' => $channel === 'inapp' ? 'sent' : 'queued',
                        ]);
                    }
                }
            }
        }
    }
}


