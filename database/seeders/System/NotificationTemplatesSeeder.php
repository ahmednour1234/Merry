<?php

namespace Database\Seeders\System;

use App\Models\NotificationTemplate;
use Illuminate\Database\Seeder;

class NotificationTemplatesSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'key' => 'export_completed',
                'channel' => 'email',
                'subject' => 'Your export is ready',
                'body' => 'Your requested export is complete. Download link: {{ link }} (expires: {{ expires_at }})',
                'is_active' => true,
            ],
            [
                'key' => 'export_completed',
                'channel' => 'inapp',
                'subject' => null,
                'body' => 'Your export is ready for download.',
                'is_active' => true,
            ],
            [
                'key' => 'maintenance_announcement',
                'channel' => 'email',
                'subject' => 'Scheduled maintenance notice',
                'body' => 'We will perform maintenance on {{ window_start }} - {{ window_end }}.',
                'is_active' => true,
            ],
            [
                'key' => 'maintenance_announcement',
                'channel' => 'inapp',
                'subject' => null,
                'body' => 'Maintenance scheduled soon. Expect limited availability.',
                'is_active' => true,
            ],
        ];

        foreach ($templates as $tpl) {
            NotificationTemplate::updateOrCreate(
                ['key' => $tpl['key'], 'channel' => $tpl['channel']],
                $tpl
            );
        }
    }
}


