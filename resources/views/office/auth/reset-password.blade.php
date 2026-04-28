@extends('office.layouts.auth')

@section('title', 'إعادة تعيين كلمة المرور')
@section('auth-subtitle', 'أدخل رمز التحقق وكلمة المرور الجديدة')

@section('content')
<form method="POST" action="{{ route('office.password.update') }}">
    @csrf

    <div style="margin-bottom:1rem;">
        <label class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" value="{{ old('email', $email ?? '') }}" class="form-input" placeholder="example@email.com" required>
        @error('email') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom:1rem;">
        <label class="form-label">رمز التحقق</label>
        <input type="text" name="code" value="{{ old('code') }}" class="form-input" placeholder="000000" maxlength="6" inputmode="numeric" style="text-align:center;letter-spacing:0.3em;font-weight:700;" required>
        @error('code') <div class="form-error">{{ $message }}</div> @enderror
        @if(app()->environment(['local','development','dev','staging','testing']))
            <p style="font-size:0.78rem;color:#059669;margin:0.25rem 0 0;">(بيئة تطوير: الرمز هو <strong>111111</strong>)</p>
        @endif
    </div>

    <div style="margin-bottom:1rem;">
        <label class="form-label">كلمة المرور الجديدة</label>
        <input type="password" name="password" id="pw1" class="form-input" placeholder="••••••••" required minlength="6">
        @error('password') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom:1.5rem;">
        <label class="form-label">تأكيد كلمة المرور</label>
        <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••" required>
    </div>

    <button type="submit" class="btn-primary">إعادة تعيين كلمة المرور</button>
</form>

<div class="auth-links">
    <a href="{{ route('office.password.request') }}">إرسال رمز جديد</a>
    <span style="margin:0 0.5rem;">·</span>
    <a href="{{ route('office.login') }}">تسجيل الدخول</a>
</div>
@endsection
