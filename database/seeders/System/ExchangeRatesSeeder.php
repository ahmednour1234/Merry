<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExchangeRatesSeeder extends Seeder
{
    public function run(): void
    {
        $conn = DB::connection('system');
        $rows = [
            ['base'=>'USD','quote'=>'EGP','rate'=>48.25000000,'fetched_at'=>now(),'active'=>1],
            ['base'=>'USD','quote'=>'SAR','rate'=>3.75000000,'fetched_at'=>now(),'active'=>1],
            ['base'=>'EUR','quote'=>'EGP','rate'=>52.00000000,'fetched_at'=>now(),'active'=>1],
        ];
        foreach ($rows as $r) {
            $conn->table('exchange_rates')->updateOrInsert(
                ['base'=>$r['base'],'quote'=>$r['quote']],
                [
                    'rate'=>$r['rate'],'fetched_at'=>$r['fetched_at'],
                    'active'=>$r['active'],'created_at'=>now(),'updated_at'=>now(),'deleted_at'=>null
                ]
            );
        }
    }
}
