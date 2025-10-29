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
        $data['password'] = Hash::make($data['password']);

        $office = Office::on('system')->create($data);

        // حفظ FCM token لو موجود
        if ($r->filled('fcm_token')) {
            OfficeFcmToken::on('system')->updateOrCreate(
                ['token' => $r->string('fcm_token')],
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
     */
    public function logout(Request $r)
    {
        /** @var Office|null $office */
        $office = $r->user();

        if ($office) {
            // احذف FCM واحد لو مبعوت، أو الكل لو مش مبعوت
            if ($r->filled('fcm_token')) {
                OfficeFcmToken::on('system')->where('token', $r->string('fcm_token'))->delete();
            } else {
                OfficeFcmToken::on('system')->where('office_id', $office->id)->delete();
            }

            // إلغاء توكن الدخول الحالي
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
        $email = $r->string('email');

        // لو الإيميل مش موجود في offices هنرجّع OK لتفادي كشف وجود الحساب
        $officeExists = Office::on('system')->where('email', $email)->exists();
        if (!$officeExists) {
            return $this->responder->ok(null, 'If the email exists, a reset code has been sent'); // عدم الإفصاح
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

        // إرسال الإيميل
        Mail::to($email)->send(new OfficeResetCodeMail($code));

        return $this->responder->ok(null, 'Reset code sent to your email');
    }

    /**
     * POST /api/v1/office/auth/reset-password
     * يُتحقق من الكود ثم يغيّر كلمة المرور.
     */
    public function reset(OfficeResetPasswordRequest $r)
    {
        $email = $r->string('email');
        $code  = $r->string('code');

        $row = DB::connection('system')->table('password_reset_tokens')->where('email', $email)->first();

        // تحقق من وجود طلب وإتاحة الكود
        if (!$row || empty($row->code_hash)) {
            return $this->responder->fail('Invalid or expired code', status:422);
        }

        // تحقق من الانتهاء
        if (!empty($row->expires_at) && now()->greaterThan($row->expires_at)) {
            // احذف السجل المنتهي
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
        $office->password = Hash::make($r->string('password'));
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
