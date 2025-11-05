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
use Illuminate\Support\Facades\Mail;
use App\Mail\OfficeResetCodeMail;
use App\Events\OfficeRegistered;

class AuthOfficeController extends ApiController
{
    public function __construct()
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * POST /api/v1/office/auth/register
     * يقبل اختيارياً: fcm_token, device, platform
     * لا يصدر توكن عند التسجيل — الحساب يبقى قيد المراجعة.
     */
    public function register(OfficeRegisterRequest $r)
    {
        $data = $r->validated();

        // إجبار الحالة الافتراضية
        $data['password'] = Hash::make((string) $data['password']);
        $data['active']   = false;       // قيد المراجعة
        $data['blocked']  = $data['blocked'] ?? false;

        $office = Office::on('system')->create($data);

        // حفظ FCM token لو موجود (مع active=false)
        $fcmToken = (string) $r->input('fcm_token', '');
        if ($fcmToken !== '') {
            OfficeFcmToken::on('system')->updateOrCreate(
                ['token' => $fcmToken],
                [
                    'office_id' => $office->id,
                    'device'    => $r->input('device'),
                    'platform'  => $r->input('platform'),
                    'active'    => false,
                ]
            );
        }

        // إرسال حدث للتنبيهات: مكتب جديد للتفعيل
        event(new OfficeRegistered($office->id));

        // لا نُعيد توكن — فقط رسالة عربية
        return $this->responder->created(
            null,
            'تم استلام طلبك، حسابك قيد المراجعة.'
        );
    }

    /** POST /api/v1/office/auth/login */
    public function login(OfficeLoginRequest $r)
    {
        $email    = (string) $r->input('email');
        $password = (string) $r->input('password');

        $office = Office::on('system')->where('email', $email)->first();

        if (!$office || !Hash::check($password, $office->password)) {
            return $this->responder->fail('بيانات الدخول غير صحيحة.', status: 401);
        }

        // أي حالة غير جاهزة → نفس الرسالة المطلوبة
        if (!$office->active || $office->blocked) {
            return $this->responder->fail('حسابك قيد المراجعة.', status: 403);
        }

        $office->last_login_at = now();
        $office->save();

        $token = $office->createToken('office', ['office'])->plainTextToken;

        return $this->responder->ok([
            'token'  => $token,
            'office' => new OfficeResource($office),
        ], 'تم تسجيل الدخول بنجاح.');
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

        return $this->responder->ok(null, 'تم تسجيل الخروج بنجاح.');
    }

    /**
     * POST /api/v1/office/auth/forgot-password
     * يُرسل كود 6 أرقام للبريد، صالح لمدة 15 دقيقة.
     * الرد دائمًا عام لتجنّب كشف وجود البريد.
     */
    public function forgot(OfficeForgotPasswordRequest $r)
    {
        $email = (string) $r->input('email');

        $exists = Office::on('system')->where('email', $email)->exists();
        if (!$exists) {
            // رسالة عامة
            return $this->responder->ok(null, 'إن وُجد البريد لدينا فسيتم إرسال رمز الاستعادة.');
        }

        // توليد كود 6 أرقام
        $code      = (string) random_int(100000, 999999);
        $hash      = Hash::make($code);
        $expiresAt = now()->addMinutes(15);

        // حفظ/تحديث السجل
        DB::connection('system')->table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token'      => null,
                'code_hash'  => $hash,
                'expires_at' => $expiresAt,
                'attempts'   => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // إرسال الإيميل
        Mail::to($email)->send(new OfficeResetCodeMail($code));

        return $this->responder->ok(null, 'تم إرسال رمز الاستعادة إلى بريدك الإلكتروني.');
    }

    /**
     * POST /api/v1/office/auth/reset-password
     * يُتحقق من الكود ثم يغيّر كلمة المرور.
     * يدعم bypass للتطوير بكود 1234 (أو من config('auth.reset_dev_code')) في بيئات غير الإنتاج.
     */
    public function reset(OfficeResetPasswordRequest $r)
    {
        $email    = (string) $r->input('email');
        $code     = (string) $r->input('code');
        $password = (string) $r->input('password');

        // إعداد كود التطوير
        $devBypassCode = (string) config('auth.reset_dev_code', '1234');
        $isDevEnv      = app()->environment(['local', 'development', 'dev', 'staging', 'testing']);
        $useBypass     = $isDevEnv && $code === $devBypassCode;

        // وجود المكتب
        $office = Office::on('system')->where('email', $email)->first();
        if (!$office) {
            return $this->responder->fail('المكتب غير موجود.', status: 404);
        }

        if (!$useBypass) {
            // جلب سجل الرمز
            $row = DB::connection('system')->table('password_reset_tokens')->where('email', $email)->first();

            if (!$row || empty($row->code_hash)) {
                return $this->responder->fail('الرمز غير صالح أو منتهٍ.', status: 422);
            }

            // انتهاء الصلاحية
            if (!empty($row->expires_at) && now()->greaterThan($row->expires_at)) {
                DB::connection('system')->table('password_reset_tokens')->where('email', $email)->delete();
                return $this->responder->fail('انتهت صلاحية الرمز.', status: 422);
            }

            // حدّ المحاولات
            $attempts = (int) ($row->attempts ?? 0);
            if ($attempts >= 5) {
                return $this->responder->fail('عدد المحاولات كبير. فضلاً اطلب رمزاً جديداً.', status: 429);
            }

            // مطابقة الرمز
            if (!Hash::check($code, $row->code_hash)) {
                DB::connection('system')->table('password_reset_tokens')
                    ->where('email', $email)
                    ->update(['attempts' => $attempts + 1, 'updated_at' => now()]);
                return $this->responder->fail('الرمز غير صحيح.', status: 422);
            }
        }

        // تغيير كلمة المرور
        $office->password = Hash::make($password);
        $office->save();

        // حذف سجل الرمز
        DB::connection('system')->table('password_reset_tokens')->where('email', $email)->delete();

        return $this->responder->ok(new OfficeResource($office), 'تم تحديث كلمة المرور بنجاح.');
    }

    /** GET /api/v1/office/me */
    public function me(Request $r)
    {
        return $this->responder->ok(new OfficeResource($r->user()), 'الملف الشخصي.');
    }
}
