<?php

namespace Database\Seeders\Identity;

use App\Models\Identity\EndUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EndUserSeeder extends Seeder
{
    public function run(): void
    {
        $records = [
            [
                'national_id' => '1234567890',
                'name' => 'End User Admin',
                'phone' => '+966500000001',
                'country_id' => 1,
                'city_id' => 1,
                'bio' => 'Seeded end user account.',
                'password' => Hash::make('password'),
                'active' => true,
            ],
            [
                'national_id' => '1234567891',
                'name' => 'Second User',
                'phone' => '+966500000002',
                'country_id' => 2,
                'city_id' => 2,
                'bio' => 'Another seeded end user.',
                'password' => Hash::make('password'),
                'active' => true,
            ],
        ];

        foreach ($records as $data) {
            EndUser::updateOrCreate(['national_id' => $data['national_id']], $data);
        }
    }
}


