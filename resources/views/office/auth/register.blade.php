@extends('office.layouts.auth')
@section('title', 'إنشاء حساب جديد')

@section('shell-content')
<div class="auth-shell">

    {{-- Form side --}}
    <div class="auth-form-panel" style="padding: 1.5rem 2rem; overflow-y: auto;">
        <div class="auth-form-inner" style="max-width:460px;">

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <div class="form-page-title">إنشاء حساب جديد</div>
            <div class="form-page-sub">أدخل بياناتك لإنشاء حساب جديد</div>

            <form method="POST" action="{{ route('office.register.post') }}" enctype="multipart/form-data">
                @csrf

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.875rem;">
                    <div class="form-group">
                        <label class="form-label">اسم المكتب</label>
                        <div class="input-wrap">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="اسم المكتب" required>
                            <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg></span>
                        </div>
                        @error('name') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">رقم السجل التجاري</label>
                        <div class="input-wrap">
                            <input type="text" name="commercial_reg_no" value="{{ old('commercial_reg_no') }}" class="form-input" placeholder="1234567890" required>
                            <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg></span>
                        </div>
                        @error('commercial_reg_no') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">البريد الإلكتروني</label>
                    <div class="input-wrap">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="example@office.com" required>
                        <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg></span>
                    </div>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.875rem;">
                    <div class="form-group">
                        <label class="form-label">رقم الجوال</label>
                        <div class="input-wrap">
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="+966 50 123 4567" required>
                            <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg></span>
                        </div>
                        @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">المدينة</label>
                        <div class="input-wrap">
                            <select name="city_id" class="form-input">
                                <option value="">اختر المدينة</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city['id'] }}" {{ old('city_id') == $city['id'] ? 'selected' : '' }}>{{ $city['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('city_id') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">العنوان</label>
                    <div class="input-wrap">
                        <input type="text" name="address" value="{{ old('address') }}" class="form-input" placeholder="المدينة، الحي، الشارع">
                        <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg></span>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.875rem;">
                    <div class="form-group">
                        <label class="form-label">كلمة المرور</label>
                        <div class="input-wrap">
                            <input type="password" name="password" id="pw1" class="form-input" placeholder="••••••••" required>
                            <span class="input-icon" style="pointer-events:all;cursor:pointer;" onclick="togglePw('pw1')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg></span>
                        </div>
                        @error('password') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">تأكيد كلمة المرور</label>
                        <div class="input-wrap">
                            <input type="password" name="password_confirmation" id="pw2" class="form-input" placeholder="••••••••" required>
                            <span class="input-icon" style="pointer-events:all;cursor:pointer;" onclick="togglePw('pw2')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">الشعار / الصورة (اختياري)</label>
                    <input type="file" name="image" accept="image/*" class="form-input" style="padding:0.4rem;">
                </div>

                <div class="form-group" style="margin-top:0.5rem;">
                    <label style="display:flex;align-items:flex-start;gap:0.5rem;cursor:pointer;font-size:0.82rem;color:#374151;">
                        <input type="checkbox" name="agree" value="1" required style="margin-top:3px;accent-color:#054F31;">
                        أوافق على <a href="#" style="color:#054F31;font-weight:600;">الشروط والأحكام وسياسة الخصوصية</a>
                    </label>
                </div>

                <button type="submit" class="btn-primary" style="margin-top:0.5rem;">إنشاء حساب</button>
            </form>

            <div class="auth-link-row">
                لديك حساب بالفعل؟ <a href="{{ route('office.login') }}">تسجيل الدخول ←</a>
            </div>
        </div>
    </div>

    {{-- Brand side --}}
    <div class="auth-brand-panel">
        <div class="brand-logo">
            <img src="{{ asset('images/merry-logo.png') }}" alt="مري">
        </div>
        <div class="brand-title">انضم إلينا الآن</div>
        <div class="brand-sub">انضم لمنصة مكتب النخبة<br>وأدر أعمالك بسهولة</div>
        <ul class="brand-features">
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg></span>إدارة السير الذاتية</li>
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg></span>متابعة الطلبات</li>
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg></span>تقارير واحصائيات</li>
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg></span>اشتراكات مرنة</li>
        </ul>
    </div>

</div>
@endsection

@push('scripts')
<script>
function togglePw(id) {
    const el = document.getElementById(id);
    el.type = el.type === 'password' ? 'text' : 'password';
}
</script>
@endpush
