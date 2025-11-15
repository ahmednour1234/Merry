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
                'name' => 'End User Admin',
                'email' => 'enduser@example.com',
                'phone' => '+966500000001',
                'country_id' => 1,
                'city_id' => 1,
                'bio' => 'Seeded end user account.',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'active' => true,
            ],
            [
                'name' => 'Second User',
                'email' => 'second.enduser@example.com',
                'phone' => '+966500000002',
                'country_id' => 2,
                'city_id' => 2,
                'bio' => 'Another seeded end user.',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'active' => true,
            ],
        ];

        foreach ($records as $data) {
            EndUser::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }
    }
}


