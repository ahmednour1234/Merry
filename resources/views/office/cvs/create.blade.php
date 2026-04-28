@extends('office.layouts.app')

@section('title', 'إضافة سيرة ذاتية')
@section('page-title', 'إضافة سيرة ذاتية')

@section('content')

<div style="max-width:640px;">
    <div style="background:#fff;border-radius:12px;padding:2rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
        <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 1.5rem;padding-bottom:0.75rem;border-bottom:1px solid #f3f4f6;">
            بيانات السيرة الذاتية
        </h3>

        <form method="POST" action="{{ route('office.cvs.store') }}" enctype="multipart/form-data">
            @csrf

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                <div>
                    <label class="form-label">الجنسية *</label>
                    <select name="nationality_code" class="form-input" required>
                        <option value="">اختر الجنسية</option>
                        @foreach($nationalities as $nat)
                            <option value="{{ $nat['code'] }}" {{ old('nationality_code') === $nat['code'] ? 'selected' : '' }}>{{ $nat['name'] }}</option>
                        @endforeach
                    </select>
                    @error('nationality_code') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="form-label">الفئة</label>
                    <select name="category_id" class="form-input">
                        <option value="">اختر الفئة</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat['id'] }}" {{ old('category_id') == $cat['id'] ? 'selected' : '' }}>{{ $cat['name'] }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="form-label">الجنس</label>
                <select name="gender" class="form-input">
                    <option value="">غير محدد</option>
                    <option value="male"   {{ old('gender') === 'male'   ? 'selected' : '' }}>ذكر</option>
                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>أنثى</option>
                </select>
                @error('gender') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                <div>
                    <label class="form-label" style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;">
                        <input type="checkbox" name="has_experience" value="1" {{ old('has_experience') ? 'checked' : '' }}
                            style="width:16px;height:16px;accent-color:#054F31;">
                        لديه/لديها خبرة
                    </label>
                </div>
                <div>
                    <label class="form-label" style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;">
                        <input type="checkbox" name="is_muslim" value="1" {{ old('is_muslim') ? 'checked' : '' }}
                            style="width:16px;height:16px;accent-color:#054F31;">
                        مسلم/مسلمة
                    </label>
                </div>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label class="form-label">ملف السيرة الذاتية (PDF) *</label>
                <div style="border:2px dashed #d1d5db;border-radius:8px;padding:1.5rem;text-align:center;cursor:pointer;transition:border-color 0.2s;"
                     onclick="document.getElementById('fileInput').click()"
                     id="dropArea">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9ca3af" style="width:36px;height:36px;margin:0 auto 0.5rem;display:block;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                    </svg>
                    <p style="font-size:0.875rem;color:#6b7280;margin:0;" id="fileLabel">اسحب الملف هنا أو اضغط للرفع</p>
                    <p style="font-size:0.75rem;color:#9ca3af;margin:0.25rem 0 0;">PDF فقط، حجم أقصى 10 MB</p>
                    <input type="file" id="fileInput" name="file" accept="application/pdf" style="display:none;" onchange="updateLabel(this)">
                </div>
                @error('file') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:flex;align-items:center;gap:0.75rem;">
                <button type="submit" class="btn-primary">رفع السيرة الذاتية</button>
                <a href="{{ route('office.cvs.index') }}" class="btn-secondary" style="text-decoration:none;">إلغاء</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function updateLabel(input) {
    const label = document.getElementById('fileLabel');
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
        label.style.color = '#054F31';
        label.style.fontWeight = '600';
    }
}
</script>
@endpush
