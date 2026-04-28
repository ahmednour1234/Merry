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
            ['code'=>'PH','name'=>'Filipino',   'image'=>'https://flagcdn.com/w40/ph.png','active'=>1,'trans'=>[['lang_code'=>'ar','name'=>'فلبيني']]],
            ['code'=>'ET','name'=>'Ethiopian',  'image'=>'https://flagcdn.com/w40/et.png','active'=>1,'trans'=>[['lang_code'=>'ar','name'=>'إثيوبي']]],
            ['code'=>'BD','name'=>'Bangladeshi','image'=>'https://flagcdn.com/w40/bd.png','active'=>1,'trans'=>[['lang_code'=>'ar','name'=>'بنغلاديشي']]],
            ['code'=>'LK','name'=>'Sri Lankan', 'image'=>'https://flagcdn.com/w40/lk.png','active'=>1,'trans'=>[['lang_code'=>'ar','name'=>'سريلانكي']]],
            ['code'=>'UG','name'=>'Ugandan',    'image'=>'https://flagcdn.com/w40/ug.png','active'=>1,'trans'=>[['lang_code'=>'ar','name'=>'أوغندي']]],
            ['code'=>'BI','name'=>'Burundian',  'image'=>'https://flagcdn.com/w40/bi.png','active'=>1,'trans'=>[['lang_code'=>'ar','name'=>'بوروندي']]],
        ];

        foreach ($items as $it) {
            $natId = $db->table('nationalities')->updateOrInsert(
                ['code'=>$it['code']],
                [
                    'name'=>$it['name'],
                    'image'=>$it['image'],
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
