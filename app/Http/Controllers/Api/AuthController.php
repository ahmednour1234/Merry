<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function login(Request $r)
    {
        $data = $r->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
            'guard'    => ['nullable','string','max:32'], // اختياري
        ]);

        $guard = $data['guard'] ?? 'api';

        /** @var User|null $user */
        $user = User::on('system')
            ->where('email', $data['email'])
            ->where('guard', $guard)
            ->where('active', true)
            ->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return $this->responder->fail('Invalid credentials', status: 401);
        }

        // اصدر توكين بقدرات/Abilities
        $abilities = ['system.manage']; // عدلها حسب احتياجك
    $token = $user->createToken('system-api', ['system.manage'])->plainTextToken;

        return $this->responder->ok([
            'token' => $token,
            'type'  => 'Bearer',
            'user'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'guard' => $user->guard,
            ],
        ], 'Logged in');
    }

    public function logout(Request $r)
    {
        $user = $r->user();
        if ($user && $r->user()->currentAccessToken()) {
            $r->user()->currentAccessToken()->delete();
        }
        return $this->responder->ok(null, 'Logged out');
    }
}
