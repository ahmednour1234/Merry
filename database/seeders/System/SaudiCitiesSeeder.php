<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SaudiCitiesSeeder extends Seeder
{
    public function run(): void
    {
        $conn = DB::connection('system');

        // لغات النظام المتاحة (نستخدمها للنسخ/الترجمة)
        $langs = $conn->table('system_languages')
            ->where('status', 'active')
            ->pluck('code')
            ->map(fn($c) => strtolower($c))
            ->values()
            ->toArray();

        // قائمة مدن سعودية (ar/en)
        $cities = [
            ['ar'=>'الرياض', 'en'=>'Riyadh'],
            ['ar'=>'جدة',   'en'=>'Jeddah'],
            ['ar'=>'مكة',   'en'=>'Makkah'],
            ['ar'=>'المدينة المنورة', 'en'=>'Madinah'],
            ['ar'=>'الدمام', 'en'=>'Dammam'],
            ['ar'=>'الخبر', 'en'=>'Khobar'],
            ['ar'=>'الظهران', 'en'=>'Dhahran'],
            ['ar'=>'الطائف', 'en'=>'Taif'],
            ['ar'=>'أبها',  'en'=>'Abha'],
            ['ar'=>'خميس مشيط', 'en'=>'Khamis Mushait'],
            ['ar'=>'جازان', 'en'=>'Jazan'],
            ['ar'=>'نجران', 'en'=>'Najran'],
            ['ar'=>'تبوك',  'en'=>'Tabuk'],
            ['ar'=>'حائل',  'en'=>'Hail'],
            ['ar'=>'بريدة', 'en'=>'Buraidah'],
            ['ar'=>'عنيزة', 'en'=>'Unaizah'],
            ['ar'=>'الهفوف', 'en'=>'Hofuf'],
            ['ar'=>'المبرز', 'en'=>'Al Mubarraz'],
            ['ar'=>'الأحساء', 'en'=>'Al Ahsa'],
            ['ar'=>'ينبع',  'en'=>'Yanbu'],
            ['ar'=>'الجبيل', 'en'=>'Jubail'],
            ['ar'=>'رأس تنورة', 'en'=>'Ras Tanura'],
            ['ar'=>'الباحة', 'en'=>'Al Bahah'],
            ['ar'=>'عرعر',  'en'=>'Arar'],
            ['ar'=>'سكاكا', 'en'=>'Sakaka'],
            ['ar'=>'القريات', 'en'=>'Qurayyat'],
            ['ar'=>'الوجه', 'en'=>'Al Wajh'],
            ['ar'=>'أملج',  'en'=>'Umluj'],
            ['ar'=>'رابغ',  'en'=>'Rabigh'],
            ['ar'=>'القنفذة', 'en'=>'Al Qunfudhah'],
        ];

        foreach ($cities as $c) {
            $slug = Str::slug($c['en'] ?? $c['ar']);
            // upsert city
            $cityId = $conn->table('cities')->updateOrInsert(
                ['slug' => $slug],
                [
                    'country_code' => 'SA',
                    'active'       => 1,
                    'updated_at'   => now(),
                    'created_at'   => now(),
                    'deleted_at'   => null,
                ]
            );

            // MySQL updateOrInsert doesn't return id; fetch it
            $city = $conn->table('cities')->where('slug',$slug)->first();
            if (!$city) continue;

            // always set ar/en if available in system_languages, otherwise skip
            $baseTranslations = [
                'ar' => $c['ar'],
                'en' => $c['en'],
            ];

            foreach ($langs as $lang) {
                $name = $baseTranslations[$lang] ?? ($baseTranslations['en'] ?? $baseTranslations['ar']);
                if (!$name) continue;

                $conn->table('city_translations')->updateOrInsert(
                    ['city_id' => $city->id, 'lang_code' => $lang],
                    ['name' => $name, 'updated_at'=> now(), 'created_at'=> now()]
                );
            }
        }
    }
}
