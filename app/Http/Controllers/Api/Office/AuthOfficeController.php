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
use Illuminate\Support\Facades\Mail;
use App\Mail\OfficeResetCodeMail;

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
        $data['password'] = Hash::make((string) $data['password']);

        $office = Office::on('system')->create($data);

        // حفظ FCM token لو موجود
        $fcmToken = (string) $r->input('fcm_token', '');
        if ($fcmToken !== '') {
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
        $email = (string) $r->input('email');
        $password = (string) $r->input('password');

        $office = Office::on('system')->where('email', $email)->first();

        if (!$office || !Hash::check($password, $office->password)) {
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
     */
    public function logout(Request $r)
    {
        /** @var Office|null $office */
        $office = $r->user();

        if ($office) {
            $fcmToken = (string) $r->input('fcm_token', '');

            if ($fcmToken !== '') {
                OfficeFcmToken::on('system')->where('token', $fcmToken)->delete();
            } else {
                OfficeFcmToken::on('system')->where('office_id', $office->id)->delete();
            }

            $office->currentAccessToken()?->delete();
        }

        return $this->responder->ok(null, 'Logged out');
    }

    /**
     * POST /api/v1/office/auth/forgot-password
     * يُرسل كود 6 أرقام للبريد، صالح لمدة 15 دقيقة.
     */
    public function forgot(OfficeForgotPasswordRequest $r)
    {
        $email = (string) $r->input('email');

        // لا نكشف إن كان البريد موجودًا أم لا
        $officeExists = Office::on('system')->where('email', $email)->exists();
        if (!$officeExists) {
            return $this->responder->ok(null, 'If the email exists, a reset code has been sent');
        }

        // توليد كود 6 أرقام
        $code = (string) random_int(100000, 999999);
        $hash = Hash::make($code);
        $expiresAt = now()->addMinutes(15);

        // حفظ/تحديث السجل
        DB::connection('system')->table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token'       => null,          // لم نعد نستخدمه
                'code_hash'   => $hash,
                'expires_at'  => $expiresAt,
                'attempts'    => 0,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        // إرسال الإيميل (لا تمرر Stringable)
        Mail::to($email)->send(new OfficeResetCodeMail($code));

        return $this->responder->ok(null, 'Reset code sent to your email');
    }

    /**
     * POST /api/v1/office/auth/reset-password
     * يُتحقق من الكود ثم يغيّر كلمة المرور.
     */
    public function reset(OfficeResetPasswordRequest $r)
    {
        $email    = (string) $r->input('email');
        $code     = (string) $r->input('code');
        $password = (string) $r->input('password');

        $row = DB::connection('system')->table('password_reset_tokens')->where('email', $email)->first();

        // تحقق من وجود طلب وإتاحة الكود
        if (!$row || empty($row->code_hash)) {
            return $this->responder->fail('Invalid or expired code', status:422);
        }

        // تحقق من الانتهاء
        if (!empty($row->expires_at) && now()->greaterThan($row->expires_at)) {
            DB::connection('system')->table('password_reset_tokens')->where('email', $email)->delete();
            return $this->responder->fail('Code expired', status:422);
        }

        // محاولات كثيرة؟
        $attempts = (int)($row->attempts ?? 0);
        if ($attempts >= 5) {
            return $this->responder->fail('Too many attempts. Request a new code.', status:429);
        }

        // تحقق من الكود
        if (!Hash::check($code, $row->code_hash)) {
            DB::connection('system')->table('password_reset_tokens')
                ->where('email', $email)
                ->update(['attempts' => $attempts + 1, 'updated_at' => now()]);
            return $this->responder->fail('Invalid code', status:422);
        }

        // يوجد مكتب؟
        $office = Office::on('system')->where('email', $email)->first();
        if (!$office) {
            return $this->responder->fail('Office not found', status:404);
        }

        // غيّر كلمة المرور
        $office->password = Hash::make($password);
        $office->save();

        // امسح السجل بعد النجاح
        DB::connection('system')->table('password_reset_tokens')->where('email', $email)->delete();

        return $this->responder->ok(new OfficeResource($office), 'Password reset');
    }

    /** GET /api/v1/office/me */
    public function me(Request $r)
    {
        return $this->responder->ok(new OfficeResource($r->user()), 'Me');
    }
}
