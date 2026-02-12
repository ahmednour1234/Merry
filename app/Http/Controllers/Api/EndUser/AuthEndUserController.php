<?php

namespace App\Http\Controllers\Api\EndUser;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\EndUser\Auth\EndUserForgotPasswordRequest;
use App\Http\Requests\EndUser\Auth\EndUserLoginRequest;
use App\Http\Requests\EndUser\Auth\EndUserRegisterRequest;
use App\Http\Requests\EndUser\Auth\EndUserResetPasswordRequest;
use App\Http\Requests\EndUser\Auth\EndUserVerifyPhoneRequest;
use App\Http\Requests\EndUser\Profile\EndUserUpdateProfileRequest;
use App\Http\Resources\EndUser\EndUserResource;
use App\Models\Identity\EndUser;
use App\Services\Notifications\NotificationService;
use App\Support\Uploads\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class AuthEndUserController extends ApiController
{
    public function __construct(protected NotificationService $notificationService)
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * POST /api/v1/enduser/auth/register
     */
    public function register(EndUserRegisterRequest $request)
    {
        $data = $request->validated();
        $user = new EndUser();
        if (!empty($data['national_id'])) {
            $user->national_id = (string) $data['national_id'];
        }
        $user->name = (string) $data['name'];
        $user->phone = (string) $data['phone'];
        $user->password = Hash::make((string) $data['password']);
        $user->active = true;
        $user->save();

        $notification = $this->notificationService->createNotification([
            'type' => 'enduser.registered',
            'title' => 'Welcome!',
            'body' => 'Your account has been created successfully.',
            'data' => ['user_id' => $user->id],
            'priority' => 'normal',
        ]);
        $this->notificationService->notifyEndUsers($notification, [$user->id], ['inapp']);

        $token = $user->createToken('enduser', ['enduser'])->plainTextToken;

        return $this->responder->created([
            'token' => $token,
            'type' => 'Bearer',
            'user' => new EndUserResource($user),
        ], 'Registration completed.');
    }

    /**
     * POST /api/v1/enduser/auth/login
     */
    public function login(EndUserLoginRequest $request)
    {
        $phone = (string) $request->input('phone');
        $password = (string) $request->input('password');

        /** @var EndUser|null $user */
        $user = EndUser::where('phone', $phone)
            ->where('active', true)
            ->first();

        if (!$user || !Hash::check($password, (string) $user->password)) {
            return $this->responder->fail('Invalid credentials.', status: 401);
        }

        $user->last_login_at = now();
        $user->save();

        $notification = $this->notificationService->createNotification([
            'type' => 'enduser.logged_in',
            'title' => 'Login Successful',
            'body' => 'You have successfully logged in.',
            'data' => ['user_id' => $user->id],
            'priority' => 'normal',
        ]);
        $this->notificationService->notifyEndUsers($notification, [$user->id], ['inapp']);

        $token = $user->createToken('enduser', ['enduser'])->plainTextToken;

        return $this->responder->ok([
            'token' => $token,
            'type' => 'Bearer',
            'user' => new EndUserResource($user),
        ], 'Logged in successfully.');
    }

    /**
     * POST /api/v1/enduser/auth/logout
     */
    public function logout(Request $request)
    {
        /** @var EndUser|null $user */
        $user = $request->user();

        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }

        return $this->responder->ok(null, 'Logged out.');
    }

    /**
     * POST /api/v1/enduser/auth/forgot-password/start
     * Step 1: Accept national_id only, return a short-lived token.
     */
    public function forgot(EndUserForgotPasswordRequest $request)
    {
        $nationalId = (string) $request->input('national_id');

        $user = EndUser::where('national_id', $nationalId)->first();
        if (!$user) {
            return $this->responder->fail('User not found.', status: 404);
        }

        $token = 'fp_' . bin2hex(random_bytes(16));
        Cache::put($token, ['national_id' => $nationalId], now()->addMinutes(10));

        return $this->responder->ok(['token' => $token], 'Proceed to phone verification.');
    }

    /**
     * POST /api/v1/enduser/auth/forgot-password/verify-phone
     * Step 2: Verify phone matches stored phone, return reset token if valid.
     */
    public function verifyPhone(EndUserVerifyPhoneRequest $request)
    {
        $token = (string) $request->input('token');
        $phone = (string) $request->input('phone');

        $payload = Cache::get($token);
        if (!$payload || empty($payload['national_id'])) {
            return $this->responder->fail('Invalid or expired token.', status: 422);
        }

        $user = EndUser::where('national_id', (string) $payload['national_id'])->first();
        if (!$user) {
            return $this->responder->fail('User not found.', status: 404);
        }

        if ((string) $user->phone !== $phone) {
            return $this->responder->fail('Phone number does not match our records.', status: 422);
        }

        // Issue reset token and invalidate previous token
        Cache::forget($token);
        $resetToken = 'rp_' . bin2hex(random_bytes(16));
        Cache::put($resetToken, ['user_id' => $user->id], now()->addMinutes(10));

        return $this->responder->ok(['reset_token' => $resetToken], 'Phone verified. You may now reset your password.');
    }

    /**
     * POST /api/v1/enduser/auth/reset-password
     * Step 3: Direct password reset using reset_token, no email/SMS.
     */
    public function reset(EndUserResetPasswordRequest $request)
    {
        $resetToken = (string) $request->input('reset_token');
        $password = (string) $request->input('password');

        $payload = Cache::get($resetToken);
        if (!$payload || empty($payload['user_id'])) {
            return $this->responder->fail('Invalid or expired reset token.', status: 422);
        }

        /** @var EndUser|null $user */
        $user = EndUser::find((int) $payload['user_id']);
        if (!$user) {
            return $this->responder->fail('User not found.', status: 404);
        }

        $user->password = Hash::make($password);
        $user->save();

        // Invalidate reset token and revoke all existing tokens (logout everywhere)
        Cache::forget($resetToken);
        $user->tokens()->delete();

        return $this->responder->ok(null, 'Password has been reset successfully, please login with your National ID and new password.');
    }

    /**
     * GET /api/v1/enduser/me
     */
    public function me(Request $request)
    {
        return $this->responder->ok(new EndUserResource($request->user()), 'Profile details.');
    }

    /**
     * PUT /api/v1/enduser/profile
     */
    public function updateProfile(EndUserUpdateProfileRequest $request)
    {
        /** @var EndUser $user */
        $user = $request->user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            ImageUploader::deleteIfExists($user->avatar_path);
            $data['avatar_path'] = ImageUploader::upload($request->file('avatar'), 'end-users');
        }

        unset($data['avatar']);

        $user->fill($data);
        $user->save();

        return $this->responder->ok(new EndUserResource($user), 'Profile updated successfully.');
    }
}


