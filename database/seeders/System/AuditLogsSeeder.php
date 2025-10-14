<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditLogsSeeder extends Seeder
{
    public function run(): void
    {
        DB::connection('system')->table('audit_logs')->insert([
            [
                'tenant_id'=>null,'user_id'=>null,'action'=>'seed',
                'model'=>null,'model_id'=>null,
                'request'=>json_encode(['source'=>'SystemDatabaseSeeder']),
                'changes'=>json_encode([]),
                'ip'=>'127.0.0.1','ua'=>'seeder',
                'active'=>1,'created_at'=>now(),'deleted_at'=>null,
            ],
        ]);
    }
}
