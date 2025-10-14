<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $conn = DB::connection('system');
        $rows = [
            ['scope'=>'global','key'=>'app.name','value'=>json_encode('Mery'),'type'=>'string','active'=>1],
            ['scope'=>'global','key'=>'app.locale','value'=>json_encode('ar'),'type'=>'string','active'=>1],
            ['scope'=>'global','key'=>'app.fallback_locale','value'=>json_encode('en'),'type'=>'string','active'=>1],
            ['scope'=>'global','key'=>'app.timezone','value'=>json_encode('Africa/Cairo'),'type'=>'string','active'=>1],
            ['scope'=>'global','key'=>'currency.default','value'=>json_encode('EGP'),'type'=>'string','active'=>1],
        ];
        foreach ($rows as $r) {
            $conn->table('system_settings')->updateOrInsert(
                ['scope'=>$r['scope'],'key'=>$r['key']],
                ['value'=>$r['value'],'type'=>$r['type'],'active'=>$r['active'],'created_at'=>now(),'updated_at'=>now()]
            );
        }
    }
}
