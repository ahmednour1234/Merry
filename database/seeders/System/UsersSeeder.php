<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $conn = DB::connection('system');

        // 1) Filament Admin user (for web/Filament login)
        $conn->table('users')->updateOrInsert(
            ['email' => 'admin@example.com'],
            [
                'name' => 'System Admin',
                'phone' => '01000000000',
                'password' => Hash::make('password'),
                'guard' => 'filament',
                'active' => 1,
                'last_login_at' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        );

        // 2) API Admin user (for API login)
        $conn->table('users')->updateOrInsert(
            ['email' => 'api@example.com'],
            [
                'name' => 'API Admin',
                'phone' => '01000000001',
                'password' => Hash::make('secret123'),
                'guard' => 'api',
                'active' => 1,
                'last_login_at' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        );

        // 3) Attach admin role to Filament user
        $filamentAdmin = $conn->table('users')->where('email','admin@example.com')->first();
        $filamentAdminId = $filamentAdmin?->id;
        $filamentRoleId = $conn->table('roles')->where('slug','admin')->where('guard','filament')->value('id');

        if ($filamentAdminId && $filamentRoleId) {
            $conn->table('role_user')->updateOrInsert(
                ['role_id'=>$filamentRoleId,'user_id'=>$filamentAdminId], []
            );
        }

        // 4) Attach admin role to API user
        $apiAdmin = $conn->table('users')->where('email','api@example.com')->first();
        $apiAdminId = $apiAdmin?->id;
        $apiRoleId = $conn->table('roles')->where('slug','admin')->where('guard','api')->value('id');

        if ($apiAdminId && $apiRoleId) {
            $conn->table('role_user')->updateOrInsert(
                ['role_id'=>$apiRoleId,'user_id'=>$apiAdminId], []
            );
        }

        // 5) (اختياري) أصدر توكين Sanctum في بيئة التطوير فقط
        if (app()->environment(['local','development']) && class_exists(\Laravel\Sanctum\PersonalAccessToken::class)) {
            $apiUserModel = \App\Models\User::on('system')->where('id', $apiAdminId)->first();
            if ($apiUserModel) {
                $token = $apiUserModel->createToken('dev-admin', ['system.manage']);
                $this->command?->info('Dev API Admin Token: '.$token->plainTextToken);
            }
        }
    }
}
