@extends('office.layouts.auth')

@section('title', 'التحقق من الهوية - OTP')
@section('auth-subtitle', 'أدخل رمز التحقق المرسل إلى بريدك')

@section('content')
<div style="text-align:center;margin-bottom:1.5rem;">
    <div style="width:56px;height:56px;background:#d1fae5;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;margin-bottom:0.75rem;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:28px;height:28px;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
        </svg>
    </div>
    <p style="font-size:0.875rem;color:#6b7280;margin:0;">تم إرسال رمز مكوّن من 6 أرقام إلى بريدك الإلكتروني</p>
    @if(app()->environment(['local','development','dev','staging','testing']))
        <p style="font-size:0.8rem;color:#059669;margin:0.25rem 0 0;font-weight:600;">(بيئة تطوير: الرمز هو <strong>111111</strong>)</p>
    @endif
</div>

<form method="POST" action="{{ route('office.otp.verify') }}">
    @csrf

    <div style="margin-bottom:1.5rem;">
        <label class="form-label">رمز التحقق</label>
        <input type="text" name="otp" class="form-input" placeholder="000000" maxlength="6" inputmode="numeric" pattern="[0-9]{6}" style="text-align:center;font-size:1.5rem;letter-spacing:0.4em;font-weight:700;" required autofocus>
        @error('otp') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn-primary">تحقق من الرمز</button>
</form>

<form method="POST" action="{{ route('office.otp.resend') }}" style="margin-top:1rem;text-align:center;">
    @csrf
    <button type="submit" style="background:none;border:none;color:#054F31;font-family:'Cairo',sans-serif;font-size:0.875rem;font-weight:600;cursor:pointer;text-decoration:underline;">إعادة إرسال الرمز</button>
</form>

<div class="auth-links">
    <a href="{{ route('office.login') }}">العودة لتسجيل الدخول</a>
</div>
@endsection
