<?php

namespace Database\Seeders\Identity;

use Illuminate\Database\Seeder;

class IdentityDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            EndUserSeeder::class,
        ]);
    }
}


