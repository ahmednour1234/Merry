<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $conn = DB::connection('system');

        // Permissions
        $perms = [
            ['slug'=>'system.read',        'name'=>'System Read',        'guard'=>'api','active'=>1],
            ['slug'=>'system.manage',      'name'=>'System Manage',      'guard'=>'api','active'=>1],
            ['slug'=>'currencies.manage',  'name'=>'Currencies Manage',  'guard'=>'api','active'=>1],
            ['slug'=>'exchange.manage',    'name'=>'Exchange Manage',    'guard'=>'api','active'=>1],
            ['slug'=>'users.manage',       'name'=>'Users Manage',       'guard'=>'api','active'=>1],
        ];
        foreach ($perms as $p) {
            $conn->table('permissions')->updateOrInsert(
                ['slug'=>$p['slug'],'guard'=>$p['guard']],
                ['name'=>$p['name'],'active'=>$p['active'],'created_at'=>now(),'updated_at'=>now(),'deleted_at'=>null]
            );
        }

        // Roles
        $roles = [
            ['slug'=>'admin','name'=>'Admin','guard'=>'api','active'=>1],
            ['slug'=>'manager','name'=>'Manager','guard'=>'api','active'=>1],
            ['slug'=>'viewer','name'=>'Viewer','guard'=>'api','active'=>1],
        ];
        foreach ($roles as $r) {
            $conn->table('roles')->updateOrInsert(
                ['slug'=>$r['slug'],'guard'=>$r['guard']],
                ['name'=>$r['name'],'active'=>$r['active'],'created_at'=>now(),'updated_at'=>now(),'deleted_at'=>null]
            );
        }

        // Attach permissions to roles
        $permIds = $conn->table('permissions')->pluck('id','slug');
        $roleIds = $conn->table('roles')->pluck('id','slug');

        $map = [
            'admin'   => ['system.read','system.manage','currencies.manage','exchange.manage','users.manage'],
            'manager' => ['system.read','currencies.manage','exchange.manage'],
            'viewer'  => ['system.read'],
        ];

        foreach ($map as $roleSlug => $permSlugs) {
            $roleId = $roleIds[$roleSlug] ?? null;
            if (!$roleId) continue;
            foreach ($permSlugs as $ps) {
                $pid = $permIds[$ps] ?? null;
                if (!$pid) continue;
                $conn->table('permission_role')->updateOrInsert(
                    ['permission_id'=>$pid,'role_id'=>$roleId],
                    []
                );
            }
        }
    }
}
