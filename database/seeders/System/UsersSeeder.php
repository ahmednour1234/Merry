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

        // 1) Admin user
        $conn->table('users')->updateOrInsert(
            ['email' => 'admin@example.com'],
            [
                'name' => 'System Admin',
                'phone' => '01000000000',
                'password' => Hash::make('secret123'),  // غيّرها في الإنتاج
                'guard' => 'api',
                'active' => 1,
                'last_login_at' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        );

        // 2) Attach admin role
        $admin   = $conn->table('users')->where('email','admin@example.com')->first();
        $adminId = $admin?->id;
        $roleId  = $conn->table('roles')->where('slug','admin')->where('guard','api')->value('id');

        if ($adminId && $roleId) {
            $conn->table('role_user')->updateOrInsert(
                ['role_id'=>$roleId,'user_id'=>$adminId], []
            );
        }

        // 3) (اختياري) أصدر توكين Sanctum في بيئة التطوير فقط
        if (app()->environment(['local','development']) && class_exists(\Laravel\Sanctum\PersonalAccessToken::class)) {
            // لازم موديل User عالأقل مُعرّف على اتصال system
            $userModel = \App\Models\User::on('system')->where('id', $adminId)->first();
            if ($userModel) {
                $token = $userModel->createToken('dev-admin', ['system.manage']);
                $this->command?->info('Dev Admin Token: '.$token->plainTextToken);
            }
        }
    }
}
