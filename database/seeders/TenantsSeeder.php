<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantsSeeder extends Seeder
{
    protected string $conn = 'system';

    public function run(): void
    {
        // Tenant واحد افتراضي (حتى لو شركة واحدة—مفيد لاختبارات لاحقة)
        $tenantId = DB::connection($this->conn)->table('tenants')->updateOrInsert(
            ['code' => 'main'],
            [
                'name'             => 'Main Company',
                'default_locale'   => 'ar',
                'default_currency' => 'SAR',
                'timezone'         => 'Africa/Cairo',
                'active'           => 1,
                'meta'             => json_encode(['plan' => 'enterprise']),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]
        );

        // لاحظ: updateOrInsert لا يرجّع ID؛ نحصل على ID عبر select لاحقًا
        $tenant = DB::connection($this->conn)->table('tenants')->where('code', 'main')->first();

        // دومين أساسي + دومين محلي للتطوير
        $domains = [
            ['tenant_id' => $tenant->id, 'host' => 'localhost',        'is_primary' => 1, 'active' => 1],
            ['tenant_id' => $tenant->id, 'host' => 'mery.local',       'is_primary' => 0, 'active' => 1],
            // لو عايز دومين إنتاج:
            // ['tenant_id' => $tenant->id, 'host' => 'api.example.com', 'is_primary' => 1, 'active' => 1],
        ];

        foreach ($domains as $d) {
            DB::connection($this->conn)->table('tenant_domains')->updateOrInsert(
                ['host' => $d['host']],
                [
                    'tenant_id'  => $d['tenant_id'],
                    'is_primary' => $d['is_primary'],
                    'active'     => $d['active'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
