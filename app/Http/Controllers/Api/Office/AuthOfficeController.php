<?php

namespace App\Http\Controllers\Api\Office;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Office\Auth\OfficeRegisterRequest;
use App\Http\Requests\Office\Auth\OfficeLoginRequest;
use App\Http\Requests\Office\Auth\OfficeForgotPasswordRequest;
use App\Http\Requests\Office\Auth\OfficeResetPasswordRequest;
use App\Http\Resources\Office\OfficeResource;
use App\Models\Office;
use App\Models\OfficeFcmToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthOfficeController extends ApiController
{
    public function __construct()
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * POST /api/v1/office/auth/register
     * يقبل اختيارياً: fcm_token, device, platform
     */
    public function register(OfficeRegisterRequest $r)
    {
        $data = $r->validated();
        $data['password'] = Hash::make($data['password']);

        $office = Office::on('system')->create($data);

        // حفظ FCM token لو موجود
        $fcmToken = $r->input('fcm_token');
        if ($fcmToken) {
            OfficeFcmToken::on('system')->updateOrCreate(
                ['token' => $fcmToken],
                [
                    'office_id' => $office->id,
                    'device'    => $r->input('device'),
                    'platform'  => $r->input('platform'),
                ]
            );
        }

        $token = $office->createToken('office', ['office'])->plainTextToken;

        return $this->responder->created([
            'token'  => $token,
            'office' => new OfficeResource($office),
        ], 'Registered');
    }

    /** POST /api/v1/office/auth/login */
    public function login(OfficeLoginRequest $r)
    {
        $office = Office::on('system')->where('email', $r->input('email'))->first();

        if (!$office || !Hash::check($r->input('password'), $office->password)) {
            return $this->responder->fail('Invalid credentials', status:401);
        }
        if (!$office->active || $office->blocked) {
            return $this->responder->fail('Office is inactive or blocked', status:403);
        }

        $office->last_login_at = now();
        $office->save();

        $token = $office->createToken('office', ['office'])->plainTextToken;

        return $this->responder->ok([
            'token'  => $token,
            'office' => new OfficeResource($office),
        ], 'Logged in');
    }

    /**
     * POST /api/v1/office/auth/logout
     * يقبل اختيارياً: fcm_token
     * - إن وُجد fcm_token نحذفه فقط
     * - إن لم يوجد نحذف كل التوكنز الخاصة بالمكتب (تقدر تغيّر السلوك حسب احتياجك)
     */
    public function logout(Request $r)
    {
        /** @var Office|null $office */
        $office = $r->user();

        // حذف FCM token(s)
        $fcmToken = $r->input('fcm_token');
        if ($office) {
            if ($fcmToken) {
                OfficeFcmToken::on('system')->where('token', $fcmToken)->delete();
            } else {
                // احذف كل توكنات المكتب الحالية (لو مش عايز كده، علّق السطر الجاي)
                OfficeFcmToken::on('system')->where('office_id', $office->id)->delete();
            }

            // إلغاء توكن الدخول الحالي
            $office->currentAccessToken()?->delete();
        }

        return $this->responder->ok(null, 'Logged out');
    }

    /** POST /api/v1/office/auth/forgot-password */
    public function forgot(OfficeForgotPasswordRequest $r)
    {
        $email = $r->input('email');

        DB::connection('system')->table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => Str::random(64), 'created_at' => now()]
        );

        return $this->responder->ok(null, 'Reset token generated');
    }

    /** POST /api/v1/office/auth/reset-password */
    public function reset(OfficeResetPasswordRequest $r)
    {
        $email = $r->input('email');
        $token = $r->input('token');

        $row = DB::connection('system')->table('password_reset_tokens')->where('email',$email)->first();
        if (!$row || $row->token !== $token) {
            return $this->responder->fail('Invalid token', status:422);
        }

        $office = Office::on('system')->where('email',$email)->first();
        if (!$office) return $this->responder->fail('Office not found', status:404);

        $office->password = Hash::make($r->input('password'));
        $office->save();

        DB::connection('system')->table('password_reset_tokens')->where('email',$email)->delete();

        return $this->responder->ok(new OfficeResource($office), 'Password reset');
    }

    /** GET /api/v1/office/me */
    public function me(Request $r)
    {
        return $this->responder->ok(new OfficeResource($r->user()), 'Me');
    }
}
