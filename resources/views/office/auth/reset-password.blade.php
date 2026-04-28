@extends('office.layouts.auth')
@section('title', 'إعادة تعيين كلمة المرور')

@section('shell-content')
<div class="auth-shell single-col">
<div class="auth-card-solo">

    <div class="solo-logo">
        <div class="solo-logo-wrap">
            <img src="{{ asset('images/merry-logo.png') }}" alt="مري">
        </div>
        <div class="solo-title">إعادة تعيين كلمة المرور</div>
        <div class="solo-sub">اختر كلمة مرور جديدة لحسابك</div>
    </div>

    @if(session('error'))   <div class="alert alert-error">{{ session('error') }}</div>   @endif
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <form method="POST" action="{{ route('office.password.update') }}">
        @csrf
        <input type="hidden" name="email" value="{{ request('email') ?? old('email') }}">
        <input type="hidden" name="token" value="{{ request('token') ?? old('token') }}">

        <div class="form-group">
            <label class="form-label">كلمة المرور الجديدة</label>
            <div class="input-wrap">
                <input type="password" name="password" id="pw1" class="form-input" placeholder="••••••••" required>
                <span class="input-icon" style="pointer-events:all;cursor:pointer;" onclick="togglePw('pw1')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg></span>
            </div>
            @error('password') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div style="display:flex;align-items:center;gap:1rem;margin-bottom:0.875rem;font-size:0.78rem;color:#6b7280;">
            <label style="display:flex;align-items:center;gap:0.35rem;cursor:pointer;"><input type="checkbox" style="accent-color:#054F31;" onchange="togglePw('pw1')"> حرف كبير وصغير</label>
            <label style="display:flex;align-items:center;gap:0.35rem;cursor:pointer;"><input type="checkbox" style="accent-color:#054F31;"> رقم ورمز خاص</label>
        </div>

        <div class="form-group">
            <label class="form-label">تأكيد كلمة المرور</label>
            <div class="input-wrap">
                <input type="password" name="password_confirmation" id="pw2" class="form-input" placeholder="••••••••" required>
                <span class="input-icon" style="pointer-events:all;cursor:pointer;" onclick="togglePw('pw2')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg></span>
            </div>
        </div>

        <button type="submit" class="btn-primary">تحديث كلمة المرور</button>
    </form>

    <div class="auth-link-row"><a href="{{ route('office.login') }}">العودة لتسجيل الدخول ←</a></div>
</div>
</div>
@endsection

@push('scripts')
<script>
function togglePw(id) {
    const el = document.getElementById(id);
    if (el) el.type = el.type === 'password' ? 'text' : 'password';
}
</script>
@endpush
