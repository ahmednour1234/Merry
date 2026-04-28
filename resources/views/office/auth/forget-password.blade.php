@extends('office.layouts.auth')
@section('title', 'نسيت كلمة المرور')

@section('shell-content')
<div class="auth-shell single-col">
<div class="auth-card-solo">

    <div class="solo-logo">
        <div class="solo-logo-wrap">
            <img src="{{ asset('images/merry-logo.png') }}" alt="مري">
        </div>
        <div class="solo-title">نسيت كلمة المرور؟</div>
        <div class="solo-sub">لا تقلق، أدخل بريدك الإلكتروني وسنرسل لك رابطاً لإعادة تعيين كلمة المرور</div>
    </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error'))   <div class="alert alert-error">{{ session('error') }}</div>   @endif

    <form method="POST" action="{{ route('office.password.send') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">البريد الإلكتروني</label>
            <div class="input-wrap">
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="example@office.com" required autofocus>
                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg></span>
            </div>
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn-primary">إرسال رابط إعادة التعيين</button>
    </form>

    @if(session('success'))
    <div style="margin-top:1.25rem;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:1rem;text-align:center;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#16a34a" style="width:28px;height:28px;display:block;margin:0 auto 0.5rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839-2.51-4.66 2.51m0 0-4.661-2.51m9.321 0a.75.75 0 0 1 0 1.5.75.75 0 0 1 0-1.5Zm-9.321 0a.75.75 0 0 1 0 1.5.75.75 0 0 1 0-1.5Z" /></svg>
        <div style="font-size:0.85rem;color:#15803d;font-weight:600;">سيتم إرسال رابط تعيين كلمة المرور<br>إلى بريدك الإلكتروني</div>
    </div>
    @endif

    <div class="auth-link-row"><a href="{{ route('office.login') }}">العودة لتسجيل الدخول ←</a></div>
</div>
</div>
@endsection
