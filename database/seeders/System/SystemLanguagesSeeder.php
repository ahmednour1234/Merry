<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemLanguagesSeeder extends Seeder
{
    public function run(): void
    {
        $conn = DB::connection('system');
        $rows = [
            ['code'=>'ar','name'=>'Arabic','native_name'=>'العربية','rtl'=>1,'status'=>'active'],
            ['code'=>'en','name'=>'English','native_name'=>'English','rtl'=>0,'status'=>'active'],
            ['code'=>'fr','name'=>'French','native_name'=>'Français','rtl'=>0,'status'=>'inactive'],
        ];
        foreach ($rows as $r) {
            $conn->table('system_languages')->updateOrInsert(
                ['code'=>$r['code']],
                [
                    'name'=>$r['name'],'native_name'=>$r['native_name'],
                    'rtl'=>$r['rtl'],'status'=>$r['status'],
                    'created_at'=>now(),'updated_at'=>now()
                ]
            );
        }
    }
}
