@extends('office.layouts.auth')

@section('title', 'استعادة كلمة المرور')
@section('auth-subtitle', 'أدخل بريدك لاستلام رمز الاستعادة')

@section('content')
<form method="POST" action="{{ route('office.password.send') }}">
    @csrf

    <div style="margin-bottom:1.5rem;">
        <label class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="example@email.com" required autofocus>
        @error('email') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn-primary">إرسال رمز الاستعادة</button>
</form>

<div class="auth-links">
    <a href="{{ route('office.login') }}">العودة لتسجيل الدخول</a>
</div>
@endsection
