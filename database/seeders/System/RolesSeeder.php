<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $conn = DB::connection('system');

        $roles = [
            ['slug'=>'admin',   'name'=>'Admin',   'guard'=>'api', 'active'=>1],
            ['slug'=>'manager', 'name'=>'Manager', 'guard'=>'api', 'active'=>1],
            ['slug'=>'viewer',  'name'=>'Viewer',  'guard'=>'api', 'active'=>1],
        ];

        foreach ($roles as $r) {
            $conn->table('roles')->updateOrInsert(
                ['slug'=>$r['slug'], 'guard'=>$r['guard']],
                [
                    'name'      => $r['name'],
                    'active'    => $r['active'],
                    'created_at'=> now(),
                    'updated_at'=> now(),
                    'deleted_at'=> null,
                ]
            );
        }
    }
}
