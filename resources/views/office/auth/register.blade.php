@extends('office.layouts.auth')
@section('title', 'إنشاء حساب جديد')

@section('shell-content')
<div class="auth-shell single-col" style="padding:1.5rem 1rem;">
<div class="auth-card-solo" style="max-width:600px;width:100%;padding:2rem;">

    {{-- Logo + Title --}}
    <div style="text-align:center;margin-bottom:1.25rem;">
        <div class="solo-logo-wrap" style="margin:0 auto 0.75rem;">
            <img src="{{ asset('images/merry-logo.png') }}" alt="ميري">
        </div>
        <div class="solo-title">إنشاء حساب جديد</div>
        <div class="solo-sub">أدخل بياناتك لإنشاء حسابك</div>
    </div>

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('office.register.post') }}" enctype="multipart/form-data">
        @csrf

        {{-- Row 1 --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
            <div class="form-group" style="margin-bottom:0.625rem;">
                <label class="form-label" style="font-size:0.8rem;margin-bottom:0.25rem;">اسم المكتب</label>
                <div class="input-wrap">
                    <input type="text" name="name" value="{{ old('name') }}" class="form-input" style="padding:0.55rem 2.2rem 0.55rem 0.75rem;font-size:0.85rem;" placeholder="اسم المكتب" required>
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg></span>
                </div>
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group" style="margin-bottom:0.625rem;">
                <label class="form-label" style="font-size:0.8rem;margin-bottom:0.25rem;">رقم السجل التجاري</label>
                <div class="input-wrap">
                    <input type="text" name="commercial_reg_no" value="{{ old('commercial_reg_no') }}" class="form-input" style="padding:0.55rem 2.2rem 0.55rem 0.75rem;font-size:0.85rem;" placeholder="1234567890" required>
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg></span>
                </div>
                @error('commercial_reg_no') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Row 2 --}}
        <div class="form-group" style="margin-bottom:0.625rem;">
            <label class="form-label" style="font-size:0.8rem;margin-bottom:0.25rem;">البريد الإلكتروني</label>
            <div class="input-wrap">
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" style="padding:0.55rem 2.2rem 0.55rem 0.75rem;font-size:0.85rem;" placeholder="example@office.com" required>
                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg></span>
            </div>
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        {{-- Row 3 --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
            <div class="form-group" style="margin-bottom:0.625rem;">
                <label class="form-label" style="font-size:0.8rem;margin-bottom:0.25rem;">رقم الجوال</label>
                <div class="input-wrap">
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-input" style="padding:0.55rem 2.2rem 0.55rem 0.75rem;font-size:0.85rem;" placeholder="+966 50 123 4567" required>
                    <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg></span>
                </div>
                @error('phone') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group" style="margin-bottom:0.625rem;">
                <label class="form-label" style="font-size:0.8rem;margin-bottom:0.25rem;">المدينة</label>
                <div class="input-wrap">
                    <select name="city_id" class="form-input" style="padding:0.55rem 2.2rem 0.55rem 0.75rem;font-size:0.85rem;">
                        <option value="">اختر المدينة</option>
                        @foreach($cities as $city)
                            <option value="{{ $city['id'] }}" {{ old('city_id') == $city['id'] ? 'selected' : '' }}>{{ $city['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                @error('city_id') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Row 4 --}}
        <div class="form-group" style="margin-bottom:0.625rem;">
            <label class="form-label" style="font-size:0.8rem;margin-bottom:0.25rem;">العنوان</label>
            <div class="input-wrap">
                <input type="text" name="address" value="{{ old('address') }}" class="form-input" style="padding:0.55rem 2.2rem 0.55rem 0.75rem;font-size:0.85rem;" placeholder="المدينة، الحي، الشارع">
                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg></span>
            </div>
        </div>

        {{-- Row 5 --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
            <div class="form-group" style="margin-bottom:0.625rem;">
                <label class="form-label" style="font-size:0.8rem;margin-bottom:0.25rem;">كلمة المرور</label>
                <div class="input-wrap">
                    <input type="password" name="password" id="pw1" class="form-input" style="padding:0.55rem 2.2rem 0.55rem 0.75rem;font-size:0.85rem;" placeholder="••••••••" required>
                    <span class="input-icon" style="pointer-events:all;cursor:pointer;" onclick="togglePw('pw1')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg></span>
                </div>
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group" style="margin-bottom:0.625rem;">
                <label class="form-label" style="font-size:0.8rem;margin-bottom:0.25rem;">تأكيد كلمة المرور</label>
                <div class="input-wrap">
                    <input type="password" name="password_confirmation" id="pw2" class="form-input" style="padding:0.55rem 2.2rem 0.55rem 0.75rem;font-size:0.85rem;" placeholder="••••••••" required>
                    <span class="input-icon" style="pointer-events:all;cursor:pointer;" onclick="togglePw('pw2')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg></span>
                </div>
            </div>
        </div>

        {{-- Row 6: file --}}
        <div class="form-group" style="margin-bottom:0.875rem;">
            <label class="form-label" style="font-size:0.8rem;margin-bottom:0.25rem;">الشعار / الصورة <span style="color:#9ca3af;font-weight:400;">(اختياري)</span></label>
            <input type="file" name="image" accept="image/*" class="form-input" style="padding:0.35rem;font-size:0.82rem;">
        </div>

        <button type="submit" class="btn-primary" style="font-size:0.95rem;padding:0.7rem;">إنشاء حساب</button>
    </form>

    <div class="auth-link-row" style="margin-top:0.875rem;font-size:0.82rem;">
        لديك حساب بالفعل؟ <a href="{{ route('office.login') }}">تسجيل الدخول ←</a>
    </div>
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
