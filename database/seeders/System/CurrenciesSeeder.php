<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesSeeder extends Seeder
{
    public function run(): void
    {
        $conn = DB::connection('system');
        $rows = [
            ['code'=>'USD','name'=>'US Dollar','symbol'=>'$','decimal'=>2,'active'=>1],
            ['code'=>'EUR','name'=>'Euro','symbol'=>'€','decimal'=>2,'active'=>1],
            ['code'=>'EGP','name'=>'Egyptian Pound','symbol'=>'E£','decimal'=>2,'active'=>1],
            ['code'=>'SAR','name'=>'Saudi Riyal','symbol'=>'﷼','decimal'=>2,'active'=>1],
        ];
        foreach ($rows as $r) {
            $conn->table('currencies')->updateOrInsert(
                ['code'=>$r['code']],
                [
                    'name'=>$r['name'],'symbol'=>$r['symbol'],'decimal'=>$r['decimal'],
                    'active'=>$r['active'],'created_at'=>now(),'updated_at'=>now(),'deleted_at'=>null
                ]
            );
        }
    }
}
