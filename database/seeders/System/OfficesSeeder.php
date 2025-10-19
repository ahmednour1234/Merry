<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OfficesSeeder extends Seeder
{
    public function run(): void
    {
        $db = DB::connection('system');

        $exists = $db->table('offices')->where('email','office@example.com')->first();
        if (!$exists) {
            $db->table('offices')->insert([
                'name' => 'مكتب التميّز',
                'commercial_reg_no' => '1010123456',
                'city_id' => null,
                'address' => 'الرياض - حي العليا',
                'phone' => '+966500000000',
                'email' => 'office@example.com',
                'password' => Hash::make('secret123'),
                'active' => 1,
                'blocked'=> 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
