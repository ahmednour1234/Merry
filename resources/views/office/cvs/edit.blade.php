@extends('office.layouts.app')

@section('title', 'تعديل سيرة ذاتية')
@section('page-title', 'تعديل سيرة ذاتية')

@section('content')

<div style="max-width:640px;">
    <div style="background:#fff;border-radius:12px;padding:2rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:1px solid #f3f4f6;">
            <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0;">تعديل السيرة الذاتية #{{ $cv->id }}</h3>
            @php
                $statusMap = [
                    'pending'  => ['label'=>'قيد الانتظار','class'=>'badge-warning'],
                    'approved' => ['label'=>'موافق عليه', 'class'=>'badge-success'],
                    'rejected' => ['label'=>'مرفوض',      'class'=>'badge-danger'],
                    'frozen'   => ['label'=>'مجمد',        'class'=>'badge-gray'],
                ];
                $st = $statusMap[$cv->status] ?? ['label'=>$cv->status,'class'=>'badge-gray'];
            @endphp
            <span class="badge {{ $st['class'] }}">{{ $st['label'] }}</span>
        </div>

        <form method="POST" action="{{ route('office.cvs.update', $cv->id) }}" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                <div>
                    <label class="form-label">الجنسية *</label>
                    <select name="nationality_code" class="form-input" required>
                        <option value="">اختر الجنسية</option>
                        @foreach($nationalities as $nat)
                            <option value="{{ $nat['code'] }}" {{ (old('nationality_code', $cv->nationality_code) === $nat['code']) ? 'selected' : '' }}>{{ $nat['name'] }}</option>
                        @endforeach
                    </select>
                    @error('nationality_code') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="form-label">الفئة</label>
                    <select name="category_id" class="form-input">
                        <option value="">اختر الفئة</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat['id'] }}" {{ (old('category_id', $cv->category_id) == $cat['id']) ? 'selected' : '' }}>{{ $cat['name'] }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="form-label">الجنس</label>
                <select name="gender" class="form-input">
                    <option value="">غير محدد</option>
                    <option value="male"   {{ old('gender', $cv->gender) === 'male'   ? 'selected' : '' }}>ذكر</option>
                    <option value="female" {{ old('gender', $cv->gender) === 'female' ? 'selected' : '' }}>أنثى</option>
                </select>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                <div>
                    <label class="form-label" style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;">
                        <input type="checkbox" name="has_experience" value="1"
                            {{ old('has_experience', $cv->has_experience) ? 'checked' : '' }}
                            style="width:16px;height:16px;accent-color:#054F31;">
                        لديه/لديها خبرة
                    </label>
                </div>
                <div>
                    <label class="form-label" style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;">
                        <input type="checkbox" name="is_muslim" value="1"
                            {{ old('is_muslim', $cv->is_muslim) ? 'checked' : '' }}
                            style="width:16px;height:16px;accent-color:#054F31;">
                        مسلم/مسلمة
                    </label>
                </div>
            </div>

            {{-- Existing file --}}
            @if($cv->file_path)
                <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:0.875rem;margin-bottom:1rem;display:flex;align-items:center;gap:0.75rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#16a34a" style="width:20px;height:20px;flex-shrink:0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <div style="flex:1;">
                        <div style="font-size:0.85rem;font-weight:600;color:#15803d;">{{ $cv->file_original_name ?? basename($cv->file_path) }}</div>
                        @if($cv->file_size) <div style="font-size:0.75rem;color:#16a34a;">{{ round($cv->file_size/1024, 1) }} KB</div> @endif
                    </div>
                    <a href="{{ route('office.cvs.download', $cv->id) }}" style="color:#16a34a;text-decoration:none;font-size:0.8rem;font-weight:600;">تحميل</a>
                </div>
            @endif

            <div style="margin-bottom:1.5rem;">
                <label class="form-label">{{ $cv->file_path ? 'تغيير الملف (اختياري)' : 'رفع ملف PDF *' }}</label>
                <div style="border:2px dashed #d1d5db;border-radius:8px;padding:1.25rem;text-align:center;cursor:pointer;"
                     onclick="document.getElementById('fileInput').click()">
                    <p style="font-size:0.875rem;color:#6b7280;margin:0;" id="fileLabel">اضغط لاختيار ملف PDF</p>
                    <p style="font-size:0.75rem;color:#9ca3af;margin:0.25rem 0 0;">PDF فقط، حجم أقصى 10 MB</p>
                    <input type="file" id="fileInput" name="file" accept="application/pdf" style="display:none;" onchange="updateLabel(this)">
                </div>
                @error('file') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:flex;align-items:center;gap:0.75rem;">
                <button type="submit" class="btn-primary">حفظ التغييرات</button>
                <a href="{{ route('office.cvs.index') }}" class="btn-secondary" style="text-decoration:none;">إلغاء</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function updateLabel(input) {
    if (input.files && input.files[0]) {
        const label = document.getElementById('fileLabel');
        label.textContent = input.files[0].name;
        label.style.color = '#054F31';
        label.style.fontWeight = '600';
    }
}
</script>
@endpush
