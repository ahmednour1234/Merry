@extends('office.layouts.auth')
@section('title', 'نسيت كلمة المرور')

@section('shell-content')
<div class="auth-shell">

    {{-- LEFT: Form --}}
    <div class="auth-form-panel">
        <div class="auth-form-inner">

            <div class="form-page-title">نسيت كلمة المرور؟</div>
            <div class="form-page-sub">لا تقلق، أدخل بريدك الإلكتروني وسنرسل لك رابطاً لإعادة تعيين كلمة المرور</div>

            @if(session('success')) <div class="alert alert-success" style="margin-top:1rem;">{{ session('success') }}</div> @endif
            @if(session('error'))   <div class="alert alert-error" style="margin-top:1rem;">{{ session('error') }}</div>   @endif

            <form method="POST" action="{{ route('office.password.send') }}" style="margin-top:1.75rem;">
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
                <div style="font-size:0.85rem;color:#15803d;font-weight:600;">تم إرسال رابط إعادة التعيين<br>تحقق من بريدك الإلكتروني</div>
            </div>
            @endif

            <div class="auth-link-row"><a href="{{ route('office.login') }}">العودة لتسجيل الدخول ←</a></div>
        </div>
    </div>

    {{-- RIGHT: Brand --}}
    <div class="auth-brand-panel">
        <div class="brand-logo">
            <img src="{{ asset('images/merry-logo.png') }}" alt="ميري">
        </div>
        <div class="brand-title">نظام ميري</div>
        <div class="brand-sub">إدارة طلبات الاستقدام<br>بكفاءة واحترافية</div>
        <ul class="brand-features">
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg></span>استعادة آمنة للحساب</li>
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg></span>إدارة السير الذاتية</li>
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg></span>تقارير واحصائيات</li>
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg></span>اشتراكات مرنة</li>
        </ul>
    </div>

</div>
@endsection
