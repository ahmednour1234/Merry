@extends('office.layouts.app')

@section('title', 'الإعدادات')
@section('page-title', 'الإعدادات')

@section('content')

<div style="max-width:600px;">
    <div style="background:#fff;border-radius:12px;padding:2rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
        <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 1.5rem;padding-bottom:0.75rem;border-bottom:1px solid #f3f4f6;">
            إعدادات الحساب
        </h3>

        <form method="POST" action="{{ route('office.settings.update') }}">
            @csrf

            <div style="margin-bottom:1rem;">
                <label class="form-label">اسم المكتب *</label>
                <input type="text" name="name" class="form-input" value="{{ old('name', $office->name) }}" required>
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                <div>
                    <label class="form-label">البريد الإلكتروني *</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $office->email) }}" required>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="form-label">رقم الهاتف *</label>
                    <input type="text" name="phone" class="form-input" value="{{ old('phone', $office->phone) }}" required>
                    @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label class="form-label">العنوان</label>
                <input type="text" name="address" class="form-input" value="{{ old('address', $office->address) }}">
            </div>

            <div style="border-top:1px solid #f3f4f6;padding-top:1.25rem;margin-bottom:1.5rem;">
                <h4 style="font-size:0.9rem;font-weight:700;color:#374151;margin:0 0 1rem;">تغيير كلمة المرور</h4>

                <div style="margin-bottom:1rem;">
                    <label class="form-label">كلمة المرور الحالية</label>
                    <input type="password" name="current_password" class="form-input" autocomplete="current-password">
                    @error('current_password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div>
                        <label class="form-label">كلمة المرور الجديدة</label>
                        <input type="password" name="password" class="form-input" autocomplete="new-password">
                        @error('password') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" class="form-input" autocomplete="new-password">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-primary">حفظ الإعدادات</button>
        </form>
    </div>
</div>

@endsection
