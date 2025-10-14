<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingsSeeder extends Seeder
{
    protected string $conn = 'system';

    public function run(): void
    {
        $rows = [
            [
                'scope' => 'global',
                'key'   => 'app.name',
                'value' => json_encode('Mery'),
                'type'  => 'string',
                'active'=> 1,
            ],
            [
                'scope' => 'global',
                'key'   => 'app.locale',
                'value' => json_encode('ar'),
                'type'  => 'string',
                'active'=> 1,
            ],
            [
                'scope' => 'global',
                'key'   => 'app.fallback_locale',
                'value' => json_encode('en'),
                'type'  => 'string',
                'active'=> 1,
            ],
            [
                'scope' => 'global',
                'key'   => 'app.timezone',
                'value' => json_encode('Africa/Cairo'),
                'type'  => 'string',
                'active'=> 1,
            ],
            [
                'scope' => 'global',
                'key'   => 'currency.default',
                'value' => json_encode('SAR'),
                'type'  => 'string',
                'active'=> 1,
            ],
        ];

        foreach ($rows as $row) {
            DB::connection($this->conn)->table('system_settings')->updateOrInsert(
                ['scope' => $row['scope'], 'key' => $row['key']],
                [
                    'value'      => $row['value'],
                    'type'       => $row['type'],
                    'active'     => $row['active'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
