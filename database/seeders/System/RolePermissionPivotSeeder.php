<?php
// database/seeders/System/RolePermissionPivotSeeder.php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionPivotSeeder extends Seeder
{
    public function run(): void
    {
        $db = DB::connection('system');

        $permIds = $db->table('permissions')->pluck('id','slug'); // slug => id
        $roleIds = $db->table('roles')->pluck('id','slug');       // slug => id

        $map = [
            'admin' => [
                // عامة
                'system.read','system.manage',
                // modules
                'system.languages.index','system.languages.store',
                'system.currencies.index','system.currencies.store','system.currencies.update','system.currencies.destroy','system.currencies.toggle',
                'system.exchange_rates.index','system.exchange_rates.store','system.exchange_rates.toggle',
                'system.users.index','system.users.store','system.users.update','system.users.destroy','system.users.toggle','system.users.sync_roles','system.users.sync_permissions',
                'system.roles.index','system.roles.store','system.roles.update','system.roles.destroy','system.roles.toggle','system.roles.sync_permissions',
                'system.permissions.index','system.permissions.store','system.permissions.update','system.permissions.destroy','system.permissions.toggle',
                'system.audit_logs.index',
            ],
            'manager' => [
                'system.read',
                'system.languages.index',
                'system.currencies.index','system.currencies.store','system.currencies.update','system.currencies.toggle',
                'system.exchange_rates.index','system.exchange_rates.store','system.exchange_rates.toggle',
                'system.users.index',
                'system.roles.index',
                'system.permissions.index',
                'system.audit_logs.index',
            ],
            'viewer' => [
                'system.read',
                'system.languages.index',
                'system.currencies.index',
                'system.exchange_rates.index',
                'system.users.index',
                'system.roles.index',
                'system.permissions.index',
                'system.audit_logs.index',
            ],
        ];

        foreach ($map as $roleSlug => $perms) {
            $roleId = $roleIds[$roleSlug] ?? null;
            if (!$roleId) continue;

            foreach ($perms as $slug) {
                $pid = $permIds[$slug] ?? null;
                if (!$pid) continue;

                $db->table('permission_role')->updateOrInsert(
                    ['permission_id'=>$pid, 'role_id'=>$roleId],
                    []
                );
            }
        }
    }
}
