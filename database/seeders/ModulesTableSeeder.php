<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    public function run(): void
    {
        // اتركه فارغًا الآن.
        // لإضافة Module لاحقًا:
        // \App\Models\Module::on('system')->updateOrCreate(
        //     ['name' => 'YourModule'],
        //     [
        //         'namespace' => 'Modules\\YourModule\\',
        //         'provider'  => 'Modules\\YourModule\\src\\YourModuleServiceProvider',
        //         'path'      => base_path('modules/YourModule'),
        //         'enabled'   => true,
        //         'meta'      => ['db' => 'your_connection'],
        //     ]
        // );
    }
}
