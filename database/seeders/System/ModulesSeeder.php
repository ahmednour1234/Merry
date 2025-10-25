<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesSeeder extends Seeder
{
    public function run(): void
    {
        $db = DB::connection('system');

        // لو جدول modules مش موجود نخرج بهدوء
        if (! $db->getSchemaBuilder()->hasTable('modules')) {
            return;
        }

        // التأكد أن عمود name مميز (اختياري لكن مستحب)
        // يفضل يكون معمول UNIQUE في الميجريشن.

        // ============== Insurance Companies ==============
        $db->table('modules')->updateOrInsert(
            ['name' => 'Insurance Companies'], // مفتاح فريد
            [
                'namespace' => 'App\\Http\\Controllers\\Api\\System',
                'provider'  => null, // ضع اسم ServiceProvider لو عندك واحد خاص بالموديول
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
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        // ====================== Cities ======================
        $db->table('modules')->updateOrInsert(
            ['name' => 'Cities'],
            [
                'namespace' => 'App\\Http\\Controllers\\Api\\System',
                'provider'  => null,
                'path'      => 'v1/admin/system/cities',
                'enabled'   => 1,
                'meta'      => json_encode([
                    'permissions_prefix' => 'system.cities',
                    'routes' => [
                        'index'   => 'GET    /api/v1/admin/system/cities',
                        'store'   => 'POST   /api/v1/admin/system/cities',
                        'update'  => 'PUT    /api/v1/admin/system/cities/{id}',
                        'destroy' => 'DELETE /api/v1/admin/system/cities/{id}',
                        'toggle'  => 'POST   /api/v1/admin/system/cities/{id}/toggle',
                    ],
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
        $db->table('modules')->updateOrInsert(
    ['name'=>'Nationalities'],
    [
        'namespace'=>'App\\Http\\Controllers\\Api\\System',
        'provider'=>null,
        'path'=>'v1/admin/system/nationalities',
        'enabled'=>1,
        'meta'=> json_encode([
            'permissions_prefix'=>'system.nationalities',
            'routes'=>[
                'index'   => 'GET    /api/v1/admin/system/nationalities',
                'store'   => 'POST   /api/v1/admin/system/nationalities',
                'update'  => 'PUT    /api/v1/admin/system/nationalities/{id}',
                'destroy' => 'DELETE /api/v1/admin/system/nationalities/{id}',
                'toggle'  => 'POST   /api/v1/admin/system/nationalities/{id}/toggle',
                'trans'   => 'POST   /api/v1/admin/system/nationalities/{id}/translations',
            ],
        ]),
        'updated_at'=>now(),
        'created_at'=>now(),
        'deleted_at'=>null,
    ]
);
$db = DB::connection('system');
if ($db->getSchemaBuilder()->hasTable('modules')) {
    $db->table('modules')->updateOrInsert(
        ['name'=>'Categories'],
        [
            'namespace'=>'App\\Http\\Controllers\\Api\\System',
            'provider'=>null,
            'path'=>'v1/admin/system/categories',
            'enabled'=>1,
            'meta'=> json_encode([
                'permissions_prefix'=>'system.categories',
                'routes'=>[
                    'index'   => 'GET    /api/v1/admin/system/categories',
                    'store'   => 'POST   /api/v1/admin/system/categories',
                    'update'  => 'PUT    /api/v1/admin/system/categories/{id}',
                    'destroy' => 'DELETE /api/v1/admin/system/categories/{id}',
                    'toggle'  => 'POST   /api/v1/admin/system/categories/{id}/toggle',
                    'trans'   => 'POST   /api/v1/admin/system/categories/{id}/translations',
                ],
            ]),
            'updated_at'=>now(),'created_at'=>now(),
            // احذف deleted_at لو جدول modules مش فيه العمود ده
        ]
    );
}

    }
}
