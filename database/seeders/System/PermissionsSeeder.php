<?php
// database/seeders/System/PermissionsSeeder.php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $db = DB::connection('system');

        $perms = [
            // عامة
            ['slug'=>'system.read',       'name'=>'System Read',        'guard'=>'api', 'active'=>1],
            ['slug'=>'system.manage',     'name'=>'System Manage',      'guard'=>'api', 'active'=>1],

            // languages
            ['slug'=>'system.languages.index',   'name'=>'List Languages',    'guard'=>'api','active'=>1],
            ['slug'=>'system.languages.store',   'name'=>'Store Language',    'guard'=>'api','active'=>1],

            // currencies
            ['slug'=>'system.currencies.index',  'name'=>'List Currencies',   'guard'=>'api','active'=>1],
            ['slug'=>'system.currencies.store',  'name'=>'Store Currency',    'guard'=>'api','active'=>1],
            ['slug'=>'system.currencies.update', 'name'=>'Update Currency',   'guard'=>'api','active'=>1],
            ['slug'=>'system.currencies.destroy','name'=>'Delete Currency',   'guard'=>'api','active'=>1],
            ['slug'=>'system.currencies.toggle', 'name'=>'Toggle Currency',   'guard'=>'api','active'=>1],

            // exchange rates
            ['slug'=>'system.exchange_rates.index',  'name'=>'List Exchange Rates', 'guard'=>'api','active'=>1],
            ['slug'=>'system.exchange_rates.store',  'name'=>'Store Exchange Rate', 'guard'=>'api','active'=>1],
            ['slug'=>'system.exchange_rates.toggle', 'name'=>'Toggle Exchange Rate','guard'=>'api','active'=>1],

            // users
            ['slug'=>'system.users.index',       'name'=>'List Users',          'guard'=>'api','active'=>1],
            ['slug'=>'system.users.store',       'name'=>'Store User',          'guard'=>'api','active'=>1],
            ['slug'=>'system.users.update',      'name'=>'Update User',         'guard'=>'api','active'=>1],
            ['slug'=>'system.users.destroy',     'name'=>'Delete User',         'guard'=>'api','active'=>1],
            ['slug'=>'system.users.toggle',      'name'=>'Toggle User',         'guard'=>'api','active'=>1],
            ['slug'=>'system.users.sync_roles',  'name'=>'Sync User Roles',     'guard'=>'api','active'=>1],
            ['slug'=>'system.users.sync_permissions','name'=>'Sync User Permissions','guard'=>'api','active'=>1],

            // roles (جديد)
            ['slug'=>'system.roles.index',            'name'=>'List Roles',              'guard'=>'api','active'=>1],
            ['slug'=>'system.roles.store',            'name'=>'Store Role',              'guard'=>'api','active'=>1],
            ['slug'=>'system.roles.update',           'name'=>'Update Role',             'guard'=>'api','active'=>1],
            ['slug'=>'system.roles.destroy',          'name'=>'Delete Role',             'guard'=>'api','active'=>1],
            ['slug'=>'system.roles.toggle',           'name'=>'Toggle Role',             'guard'=>'api','active'=>1],
            ['slug'=>'system.roles.sync_permissions', 'name'=>'Sync Role Permissions',   'guard'=>'api','active'=>1],

            // permissions (جديد)
            ['slug'=>'system.permissions.index',  'name'=>'List Permissions',   'guard'=>'api','active'=>1],
            ['slug'=>'system.permissions.store',  'name'=>'Store Permission',   'guard'=>'api','active'=>1],
            ['slug'=>'system.permissions.update', 'name'=>'Update Permission',  'guard'=>'api','active'=>1],
            ['slug'=>'system.permissions.destroy','name'=>'Delete Permission',  'guard'=>'api','active'=>1],
            ['slug'=>'system.permissions.toggle', 'name'=>'Toggle Permission',  'guard'=>'api','active'=>1],

            // audit logs (اختياري عرض فقط)
            ['slug'=>'system.audit_logs.index',  'name'=>'List Audit Logs',    'guard'=>'api','active'=>1],
            // insurance companies
['slug'=>'system.insurance_companies.index',  'name'=>'List Insurance Companies', 'guard'=>'api','active'=>1],
['slug'=>'system.insurance_companies.store',  'name'=>'Store Insurance Company',  'guard'=>'api','active'=>1],
['slug'=>'system.insurance_companies.update', 'name'=>'Update Insurance Company', 'guard'=>'api','active'=>1],
['slug'=>'system.insurance_companies.destroy','name'=>'Delete Insurance Company', 'guard'=>'api','active'=>1],
['slug'=>'system.insurance_companies.toggle', 'name'=>'Toggle Insurance Company', 'guard'=>'api','active'=>1],
['slug'=>'system.cities.index',  'name'=>'List Cities',  'guard'=>'api','active'=>1],
['slug'=>'system.cities.store',  'name'=>'Store City',   'guard'=>'api','active'=>1],
['slug'=>'system.cities.update', 'name'=>'Update City',  'guard'=>'api','active'=>1],
['slug'=>'system.cities.destroy','name'=>'Delete City',  'guard'=>'api','active'=>1],
['slug'=>'system.cities.toggle', 'name'=>'Toggle City',  'guard'=>'api','active'=>1],
['slug'=>'system.offices.index','name'=>'List Offices','guard'=>'api','active'=>1],
['slug'=>'system.offices.store','name'=>'Store Office','guard'=>'api','active'=>1],
['slug'=>'system.offices.update','name'=>'Update Office','guard'=>'api','active'=>1],
['slug'=>'system.offices.block','name'=>'Block/Unblock Office','guard'=>'api','active'=>1],
['slug'=>'system.offices.toggle','name'=>'Toggle Office','guard'=>'api','active'=>1],
['slug'=>'system.offices.destroy','name'=>'Delete Office','guard'=>'api','active'=>1],

        ];

        foreach ($perms as $p) {
            $db->table('permissions')->updateOrInsert(
                ['slug'=>$p['slug'], 'guard'=>$p['guard']],
                [
                    'name'       => $p['name'],
                    'active'     => $p['active'],
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ]
            );
        }
    }
}
