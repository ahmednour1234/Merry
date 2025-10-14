<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;

class SystemDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SystemSettingsSeeder::class,
            SystemLanguagesSeeder::class,
            CurrenciesSeeder::class,
            ExchangeRatesSeeder::class,
            RolesPermissionsSeeder::class,
            UsersSeeder::class,
            RolesSeeder::class,
            PermissionsSeeder::class,
            RolePermissionPivotSeeder::class, // اختياري للربط
            // AuditLogsSeeder::class, // اختياري
        ]);
    }
}
