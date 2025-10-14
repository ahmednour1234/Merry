<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesSeeder extends Seeder
{
    public function run(): void
    {
        $db = DB::connection('system');
        if (!$db->getSchemaBuilder()->hasTable('modules')) return;

        // Insurance Companies module
        $db->table('modules')->updateOrInsert(
            ['name' => 'Insurance Companies'], // مفتاح فريد (name)
            [
                'namespace' => 'App\\Http\\Controllers\\Api\\System',
                'provider'  => null, // لو عندك ServiceProvider خاص بالموديول حط اسمه هنا
                'path'      => 'v1/admin/system/insurance-companies',
                'enabled'   => 1,
                'meta'      => json_encode([
                    'permissions_prefix' => 'system.insurance_companies',
                    'routes' => [
                        'index'   => 'GET    /api/v1/admin/system/insurance-companies',
                        'store'   => 'POST   /api/v1/admin/system/insurance-companies',
                        'update'  => 'PUT    /api/v1/admin/system/insurance-companies/{id}',
                        'destroy' => 'DELETE /api/v1/admin/system/insurance-companies/{id}',
                        'toggle'  => 'POST   /api/v1/admin/system/insurance-companies/{id}/toggle',
                    ],
                ]),
                'updated_at' => now(),
                'created_at' => now(),
                'deleted_at' => null,
            ]
        );
    }
}
