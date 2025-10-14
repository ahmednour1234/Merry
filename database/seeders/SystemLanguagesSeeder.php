<?php

namespace Database\Seeders;

use App\Models\SystemLanguage;
use Illuminate\Database\Seeder;

class SystemLanguagesSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'code' => 'en',
                'name' => 'English',
                'native_name' => 'English',
                'rtl' => false,
                'status' => 'active',
                'meta' => ['plural_rules' => 'en'],
            ],
            [
                'code' => 'ar',
                'name' => 'Arabic',
                'native_name' => 'العربية',
                'rtl' => true,
                'status' => 'active',
                'meta' => ['plural_rules' => 'ar'],
            ],
            // أضف لغات أخرى لو حابب
        ];

        foreach ($rows as $row) {
            SystemLanguage::on('system')->updateOrCreate(
                ['code' => $row['code']],
                $row
            );
        }
    }
}
