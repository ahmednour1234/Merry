<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    public function run(): void
    {
        $db = DB::connection('system');

        // ══════════════════════════════════════════
        //  الباقات — عملة ريال سعودي SAR
        // ══════════════════════════════════════════
        $plans = [
            [
                'code'          => 'free',
                'name'          => 'Free',
                'description'   => 'الباقة المجانية للبدء',
                'base_currency' => 'SAR',
                'base_price'    => 0.00,
                'billing_cycle' => 'monthly',
                'active'        => 1,
            ],
            [
                'code'          => 'basic',
                'name'          => 'Basic',
                'description'   => 'للمكاتب الصغيرة',
                'base_currency' => 'SAR',
                'base_price'    => 99.00,
                'billing_cycle' => 'monthly',
                'active'        => 1,
            ],
            [
                'code'          => 'pro',
                'name'          => 'Pro',
                'description'   => 'للمكاتب النامية',
                'base_currency' => 'SAR',
                'base_price'    => 299.00,
                'billing_cycle' => 'monthly',
                'active'        => 1,
            ],
            [
                'code'          => 'enterprise',
                'name'          => 'Enterprise',
                'description'   => 'للمكاتب الكبيرة — مزايا غير محدودة',
                'base_currency' => 'SAR',
                'base_price'    => 749.00,
                'billing_cycle' => 'monthly',
                'active'        => 1,
            ],
        ];

        foreach ($plans as $p) {
            $db->table('plans')->updateOrInsert(
                ['code' => $p['code']],
                array_merge($p, ['updated_at'=>now(),'created_at'=>now(),'deleted_at'=>null])
            );
        }

        // ══════════════════════════════════════════
        //  الترجمات العربية
        // ══════════════════════════════════════════
        $translations = [
            ['plan_code'=>'free',       'lang_code'=>'ar','name'=>'مجانية',    'description'=>'ابدأ مجاناً بدون بطاقة'],
            ['plan_code'=>'basic',      'lang_code'=>'ar','name'=>'أساسية',    'description'=>'للمكاتب الصغيرة'],
            ['plan_code'=>'pro',        'lang_code'=>'ar','name'=>'احترافية',   'description'=>'للمكاتب النامية'],
            ['plan_code'=>'enterprise', 'lang_code'=>'ar','name'=>'مؤسسات',    'description'=>'للمكاتب الكبيرة'],
        ];
        foreach ($translations as $tr) {
            $db->table('plan_translations')->updateOrInsert(
                ['plan_code'=>$tr['plan_code'], 'lang_code'=>$tr['lang_code']],
                ['name'=>$tr['name'],'description'=>$tr['description'],'updated_at'=>now(),'created_at'=>now()]
            );
        }

        // ══════════════════════════════════════════
        //  الميزات — cv.limit + bookings.limit
        // ══════════════════════════════════════════
        $features = [
            // ─── مجانية ───────────────────────────────────────
            ['plan_code'=>'free', 'feature_key'=>'cv.limit',       'limit'=>10,   'value'=>null,              'active'=>1],
            ['plan_code'=>'free', 'feature_key'=>'bookings.limit',  'limit'=>5,    'value'=>null,              'active'=>1],
            ['plan_code'=>'free', 'feature_key'=>'upload.allowed',  'limit'=>null, 'value'=>json_encode(true), 'active'=>1],

            // ─── أساسية ───────────────────────────────────────
            ['plan_code'=>'basic', 'feature_key'=>'cv.limit',       'limit'=>100,  'value'=>null,              'active'=>1],
            ['plan_code'=>'basic', 'feature_key'=>'bookings.limit',  'limit'=>50,   'value'=>null,              'active'=>1],
            ['plan_code'=>'basic', 'feature_key'=>'upload.allowed',  'limit'=>null, 'value'=>json_encode(true), 'active'=>1],

            // ─── احترافية ─────────────────────────────────────
            ['plan_code'=>'pro', 'feature_key'=>'cv.limit',         'limit'=>500,  'value'=>null,              'active'=>1],
            ['plan_code'=>'pro', 'feature_key'=>'bookings.limit',    'limit'=>300,  'value'=>null,              'active'=>1],
            ['plan_code'=>'pro', 'feature_key'=>'upload.allowed',    'limit'=>null, 'value'=>json_encode(true), 'active'=>1],
            ['plan_code'=>'pro', 'feature_key'=>'support.priority',  'limit'=>null, 'value'=>json_encode(true), 'active'=>1],

            // ─── مؤسسات (غير محدود) ───────────────────────────
            ['plan_code'=>'enterprise', 'feature_key'=>'cv.limit',        'limit'=>null, 'value'=>null,              'active'=>1],
            ['plan_code'=>'enterprise', 'feature_key'=>'bookings.limit',   'limit'=>null, 'value'=>null,              'active'=>1],
            ['plan_code'=>'enterprise', 'feature_key'=>'upload.allowed',   'limit'=>null, 'value'=>json_encode(true), 'active'=>1],
            ['plan_code'=>'enterprise', 'feature_key'=>'support.priority', 'limit'=>null, 'value'=>json_encode(true), 'active'=>1],
            ['plan_code'=>'enterprise', 'feature_key'=>'office.multi_branch','limit'=>null,'value'=>json_encode(true),'active'=>1],
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
