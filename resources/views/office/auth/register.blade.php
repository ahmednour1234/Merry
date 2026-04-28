@extends('office.layouts.auth')

@section('title', 'إنشاء حساب جديد')
@section('auth-subtitle', 'أنشئ حساب مكتبك للاستقدام')

@section('content')
<form method="POST" action="{{ route('office.register.post') }}" enctype="multipart/form-data">
    @csrf

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.875rem;margin-bottom:0.875rem;">
        <div>
            <label class="form-label">اسم المكتب *</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="مكتب النخبة" required>
            @error('name') <div class="form-error">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="form-label">رقم السجل التجاري *</label>
            <input type="text" name="commercial_reg_no" value="{{ old('commercial_reg_no') }}" class="form-input" placeholder="1234567890" required>
            @error('commercial_reg_no') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.875rem;margin-bottom:0.875rem;">
        <div>
            <label class="form-label">المدينة</label>
            <select name="city_id" class="form-input">
                <option value="">اختر المدينة</option>
                @foreach($cities as $city)
                    <option value="{{ $city['id'] }}" {{ old('city_id') == $city['id'] ? 'selected' : '' }}>{{ $city['name'] }}</option>
                @endforeach
            </select>
            @error('city_id') <div class="form-error">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="form-label">رقم الهاتف</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="+966XXXXXXXXX">
            @error('phone') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>

    <div style="margin-bottom:0.875rem;">
        <label class="form-label">العنوان</label>
        <textarea name="address" class="form-input" rows="2" placeholder="العنوان التفصيلي">{{ old('address') }}</textarea>
        @error('address') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom:0.875rem;">
        <label class="form-label">البريد الإلكتروني *</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="office@example.com" required>
        @error('email') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.875rem;margin-bottom:0.875rem;">
        <div>
            <label class="form-label">كلمة المرور *</label>
            <input type="password" name="password" class="form-input" placeholder="••••••••" required minlength="6">
            @error('password') <div class="form-error">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="form-label">تأكيد كلمة المرور *</label>
            <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••" required>
        </div>
    </div>

    <div style="margin-bottom:1.5rem;">
        <label class="form-label">شعار المكتب (اختياري)</label>
        <input type="file" name="image" class="form-input" accept="image/jpg,image/jpeg,image/png,image/webp">
        @error('image') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn-primary">إنشاء الحساب</button>
</form>

<div class="auth-links">
    لديك حساب بالفعل؟ <a href="{{ route('office.login') }}">تسجيل الدخول</a>
</div>
@endsection
