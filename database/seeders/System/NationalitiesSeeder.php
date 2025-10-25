<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitiesSeeder extends Seeder
{
    public function run(): void
    {
        $db = DB::connection('system');

        $items = [
            ['code'=>'SA','name'=>'Saudi','active'=>1, 'trans'=>[['lang_code'=>'ar','name'=>'سعودي']]],
            ['code'=>'EG','name'=>'Egyptian','active'=>1, 'trans'=>[['lang_code'=>'ar','name'=>'مصري']]],
            ['code'=>'PH','name'=>'Filipino','active'=>1, 'trans'=>[['lang_code'=>'ar','name'=>'فلبيني']]],
            ['code'=>'IN','name'=>'Indian','active'=>1, 'trans'=>[['lang_code'=>'ar','name'=>'هندي']]],
        ];

        foreach ($items as $it) {
            $natId = $db->table('nationalities')->updateOrInsert(
                ['code'=>$it['code']],
                [
                    'name'=>$it['name'],
                    'active'=>$it['active'],
                    'meta'=>json_encode([]),
                    'created_at'=>now(),
                    'updated_at'=>now(),
                    'deleted_at'=>null,
                ]
            );

            // جب id
            $row = $db->table('nationalities')->where('code',$it['code'])->first();

            if (!empty($it['trans']) && $row) {
                foreach ($it['trans'] as $t) {
                    $db->table('nationality_translations')->updateOrInsert(
                        ['nationality_id'=>$row->id, 'lang_code'=>$t['lang_code']],
                        [
                            'name'=>$t['name'],
                            'created_at'=>now(), 'updated_at'=>now(),
                            'deleted_at'=>null,
                        ]
                    );
                }
            }
        }
    }
}
