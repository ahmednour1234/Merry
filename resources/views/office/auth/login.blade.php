@extends('office.layouts.auth')

@section('title', 'تسجيل الدخول')
@section('auth-subtitle', 'سجّل دخولك للوحة التحكم')

@section('content')
<form method="POST" action="{{ route('office.login.post') }}">
    @csrf

    <div style="margin-bottom:1rem;">
        <label class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="example@email.com" required autofocus>
        @error('email') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom:1.5rem;">
        <label class="form-label">كلمة المرور</label>
        <div style="position:relative;">
            <input type="password" name="password" id="passwordInput" class="form-input" placeholder="••••••••" required>
            <button type="button" onclick="togglePassword()" style="position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#9ca3af;padding:0;">
                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:18px;height:18px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>
        </div>
        @error('password') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn-primary">تسجيل الدخول</button>
</form>

<div class="auth-links">
    <a href="{{ route('office.password.request') }}">نسيت كلمة المرور؟</a>
    <span style="margin:0 0.5rem;">·</span>
    <a href="{{ route('office.register') }}">إنشاء حساب جديد</a>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('passwordInput');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endsection
