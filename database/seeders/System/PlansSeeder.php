<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    public function run(): void
    {
        $db = DB::connection('system');

        // خطط أساسية
        $plans = [
            [
                'code' => 'free',
                'name' => 'Free',
                'description' => 'Basic plan',
                'base_currency' => 'USD',
                'base_price' => 0,
                'billing_cycle' => 'monthly',
                'active' => 1,
            ],
            [
                'code' => 'pro',
                'name' => 'Pro',
                'description' => 'For growing offices',
                'base_currency' => 'USD',
                'base_price' => 49.99,
                'billing_cycle' => 'monthly',
                'active' => 1,
            ],
            [
                'code' => 'enterprise',
                'name' => 'Enterprise',
                'description' => 'Advanced features and support',
                'base_currency' => 'USD',
                'base_price' => 199.00,
                'billing_cycle' => 'monthly',
                'active' => 1,
            ],
        ];

        foreach ($plans as $p) {
            $db->table('plans')->updateOrInsert(
                ['code' => $p['code']],
                array_merge($p, ['updated_at'=>now(),'created_at'=>now(),'deleted_at'=>null])
            );
        }

        // ترجمات عربية
        $translations = [
            ['plan_code'=>'free','lang_code'=>'ar','name'=>'مجانية','description'=>'باقة أساسية'],
            ['plan_code'=>'pro','lang_code'=>'ar','name'=>'احترافية','description'=>'للمكاتب النامية'],
            ['plan_code'=>'enterprise','lang_code'=>'ar','name'=>'مؤسسات','description'=>'مزايا ودعم متقدم'],
        ];
        foreach ($translations as $tr) {
            $db->table('plan_translations')->updateOrInsert(
                ['plan_code'=>$tr['plan_code'], 'lang_code'=>$tr['lang_code']],
                ['name'=>$tr['name'],'description'=>$tr['description'],'updated_at'=>now(),'created_at'=>now()]
            );
        }

        // خصائص
        $features = [
            // Free
            ['plan_code'=>'free','feature_key'=>'cv.limit','limit'=>50,'value'=>null,'active'=>1],
            ['plan_code'=>'free','feature_key'=>'orders.limit','limit'=>5,'value'=>null,'active'=>1],
            ['plan_code'=>'free','feature_key'=>'upload.allowed','limit'=>null,'value'=>json_encode(true),'active'=>1],

            // Pro
            ['plan_code'=>'pro','feature_key'=>'cv.limit','limit'=>2000,'value'=>null,'active'=>1],
            ['plan_code'=>'pro','feature_key'=>'orders.limit','limit'=>200,'value'=>null,'active'=>1],
            ['plan_code'=>'pro','feature_key'=>'upload.allowed','limit'=>null,'value'=>json_encode(true),'active'=>1],
            ['plan_code'=>'pro','feature_key'=>'support.priority','limit'=>null,'value'=>json_encode(true),'active'=>1],

            // Enterprise
            ['plan_code'=>'enterprise','feature_key'=>'cv.limit','limit'=>null,'value'=>null,'active'=>1], // unlimited
            ['plan_code'=>'enterprise','feature_key'=>'orders.limit','limit'=>null,'value'=>null,'active'=>1],
            ['plan_code'=>'enterprise','feature_key'=>'upload.allowed','limit'=>null,'value'=>json_encode(true),'active'=>1],
            ['plan_code'=>'enterprise','feature_key'=>'support.priority','limit'=>null,'value'=>json_encode(true),'active'=>1],
        ];

        foreach ($features as $f) {
            $db->table('plan_features')->updateOrInsert(
                ['plan_code'=>$f['plan_code'], 'feature_key'=>$f['feature_key']],
                [
                    'limit'=>$f['limit'],
                    'value'=>$f['value'],
                    'active'=>$f['active'],
                    'updated_at'=>now(),
                    'created_at'=>now(),
                ]
            );
        }

        // بروموشن ترحيبي
        $db->table('promotions')->updateOrInsert(
            ['name'=>'Welcome 20%'],
            [
                'plan_code'=>null, // كل الخطط
                'type'=>'percent',
                'amount'=>20,
                'currency_code'=>null,
                'starts_at'=>now()->subDay(),
                'ends_at'=>now()->addMonth(),
                'auto_apply'=>true,
                'active'=>1,
                'updated_at'=>now(),
                'created_at'=>now(),
                'deleted_at'=>null,
            ]
        );
    }
}
