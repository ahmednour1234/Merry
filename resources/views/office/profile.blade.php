@extends('office.layouts.app')

@section('title', 'الملف الشخصي')
@section('page-title', 'الملف الشخصي')

@section('content')

<div style="max-width:700px;">
    <div style="background:#fff;border-radius:12px;padding:2rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);">

        {{-- Avatar & name header --}}
        <div style="display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:1px solid #f3f4f6;">
            @if($office->image)
                <img src="{{ asset('storage/'.$office->image) }}" alt="{{ $office->name }}"
                     style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:3px solid #054F31;">
            @else
                <div style="width:72px;height:72px;border-radius:50%;background:#e8f5ef;display:flex;align-items:center;justify-content:center;border:3px solid #054F31;font-size:1.75rem;font-weight:800;color:#054F31;">
                    {{ mb_substr($office->name, 0, 1) }}
                </div>
            @endif
            <div>
                <div style="font-size:1.2rem;font-weight:800;color:#111827;">{{ $office->name }}</div>
                <div style="color:#6b7280;font-size:0.85rem;">{{ $office->email }}</div>
                <div style="margin-top:0.35rem;">
                    @if($office->active)
                        <span class="badge badge-success">نشط</span>
                    @else
                        <span class="badge badge-danger">غير نشط</span>
                    @endif
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('office.profile.update') }}" enctype="multipart/form-data">
            @csrf

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                <div>
                    <label class="form-label">اسم المكتب *</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $office->name) }}" required>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="form-label">البريد الإلكتروني *</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $office->email) }}" required>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                <div>
                    <label class="form-label">رقم الهاتف *</label>
                    <input type="text" name="phone" class="form-input" value="{{ old('phone', $office->phone) }}" required>
                    @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="form-label">المدينة</label>
                    <select name="city_id" class="form-input">
                        <option value="">اختر المدينة</option>
                        @foreach($cities as $city)
                            <option value="{{ $city['id'] }}" {{ old('city_id', $office->city_id) == $city['id'] ? 'selected' : '' }}>{{ $city['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="form-label">العنوان</label>
                <input type="text" name="address" class="form-input" value="{{ old('address', $office->address) }}">
            </div>

            <div style="margin-bottom:1rem;">
                <label class="form-label">الصورة (اختياري)</label>
                <input type="file" name="image" accept="image/*" class="form-input" style="padding:0.35rem;">
                @error('image') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="border-top:1px solid #f3f4f6;padding-top:1.25rem;margin-top:1.25rem;">
                <h4 style="font-size:0.9rem;font-weight:700;color:#374151;margin:0 0 1rem;">تغيير كلمة المرور (اتركه فارغاً إذا لم ترد التغيير)</h4>
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

            <div style="margin-top:1.5rem;">
                <button type="submit" class="btn-primary">حفظ التغييرات</button>
            </div>
        </form>
    </div>
</div>

@endsection
