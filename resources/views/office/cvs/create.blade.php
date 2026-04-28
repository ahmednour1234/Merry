@extends('office.layouts.app')

@section('title', 'إضافة سيرة ذاتية')

@push('styles')
<style>
    .field-group { margin-bottom:1.4rem; }
    .field-label { display:block;font-size:.82rem;font-weight:700;color:#374151;margin-bottom:.45rem; }
    .field-label span.req { color:#ef4444;margin-right:2px; }
    .field-select, .field-file-inner { width:100%;border:1.5px solid #e5e7eb;border-radius:10px;padding:.65rem .9rem;font-size:.875rem;color:#111827;outline:none;transition:border-color .15s,box-shadow .15s;background:#fff;appearance:none;-webkit-appearance:none; }
    .field-select:focus { border-color:#054F31;box-shadow:0 0 0 3px rgba(5,79,49,.08); }
    .drop-zone { border:2px dashed #d1fae5;border-radius:14px;padding:2.5rem 1rem;text-align:center;cursor:pointer;transition:all .2s;background:#f9fafb; }
    .drop-zone:hover,.drop-zone.drag { border-color:#054F31;background:#f0fdf4; }
    .drop-zone.has-file { border-color:#054F31;background:#f0fdf4;border-style:solid; }
    .check-card { display:flex;align-items:center;gap:.75rem;padding:.85rem 1rem;border:1.5px solid #e5e7eb;border-radius:12px;cursor:pointer;transition:all .15s;background:#fff; }
    .check-card:hover { border-color:#a7f3d0;background:#f0fdf4; }
    .check-card input[type=checkbox]:checked ~ * { color:#054F31; }
    .check-card.checked { border-color:#054F31;background:#f0fdf4; }
    .check-icon { width:36px;height:36px;border-radius:10px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background .15s; }
    .check-card.checked .check-icon { background:#d1fae5; }
    .section-divider { display:flex;align-items:center;gap:.75rem;margin:1.75rem 0 1.4rem; }
    .section-divider span { font-size:.78rem;font-weight:800;color:#054F31;white-space:nowrap;background:#e8f5e9;padding:.3rem .75rem;border-radius:99px; }
    .section-divider:before,.section-divider:after { content:'';flex:1;height:1px;background:#e5e7eb; }
</style>
@endpush

@section('content')

<form method="POST" action="{{ route('office.cvs.store') }}" enctype="multipart/form-data">
@csrf

<div style="display:grid;grid-template-columns:1fr 380px;gap:1.5rem;align-items:start;">

    {{-- ════ MAIN CARD ════ --}}
    <div style="background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(0,0,0,.07);overflow:hidden;">

        {{-- Card Header --}}
        <div style="background:linear-gradient(135deg,#054F31 0%,#0a6b42 100%);padding:1.4rem 1.75rem;display:flex;align-items:center;gap:1rem;">
            <div style="width:46px;height:46px;border-radius:14px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:24px;height:24px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
            </div>
            <div>
                <div style="color:#fff;font-weight:800;font-size:1.05rem;">إضافة سيرة ذاتية جديدة</div>
                <div style="color:rgba(255,255,255,.6);font-size:.75rem;">أدخل بيانات السيرة الذاتية بدقة</div>
            </div>
        </div>

        {{-- Card Body --}}
        <div style="padding:1.75rem;">

            {{-- Section: المعلومات الأساسية --}}
            <div class="section-divider"><span>المعلومات الأساسية</span></div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.1rem;">
                <div class="field-group">
                    <label class="field-label">الجنسية <span class="req">*</span></label>
                    <div style="position:relative;">
                        <select name="nationality_code" class="field-select" required>
                            <option value="">اختر الجنسية</option>
                            @foreach($nationalities as $nat)
                                <option value="{{ $nat['code'] }}" {{ old('nationality_code') === $nat['code'] ? 'selected' : '' }}>{{ $nat['name'] }}</option>
                            @endforeach
                        </select>
                        <div style="position:absolute;top:50%;left:.9rem;transform:translateY(-50%);pointer-events:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#9ca3af" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                        </div>
                    </div>
                    @error('nationality_code') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="field-group">
                    <label class="field-label">الفئة</label>
                    <div style="position:relative;">
                        <select name="category_id" class="field-select">
                            <option value="">اختر الفئة</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat['id'] }}" {{ old('category_id') == $cat['id'] ? 'selected' : '' }}>{{ $cat['name'] }}</option>
                            @endforeach
                        </select>
                        <div style="position:absolute;top:50%;left:.9rem;transform:translateY(-50%);pointer-events:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#9ca3af" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                        </div>
                    </div>
                    @error('category_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="field-group" style="max-width:50%;padding-left:.55rem;">
                <label class="field-label">الجنس</label>
                <div style="position:relative;">
                    <select name="gender" class="field-select">
                        <option value="">غير محدد</option>
                        <option value="male"   {{ old('gender') === 'male'   ? 'selected' : '' }}>ذكر</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>أنثى</option>
                    </select>
                    <div style="position:absolute;top:50%;left:.9rem;transform:translateY(-50%);pointer-events:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#9ca3af" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                    </div>
                </div>
                @error('gender') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            {{-- Section: الخصائص --}}
            <div class="section-divider"><span>الخصائص</span></div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.4rem;">
                <label class="check-card {{ old('has_experience') ? 'checked' : '' }}" id="card-exp" onclick="toggleCard(this,'exp')">
                    <input type="checkbox" name="has_experience" value="1" id="cb-exp" {{ old('has_experience') ? 'checked' : '' }} style="display:none;">
                    <div class="check-icon" id="icon-exp">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ old('has_experience') ? '#054F31' : '#9ca3af' }}" style="width:18px;height:18px;" id="svg-exp"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:.85rem;font-weight:700;color:#111827;">لديه/لديها خبرة</div>
                        <div style="font-size:.72rem;color:#9ca3af;">يمتلك خبرة عمل سابقة</div>
                    </div>
                </label>

                <label class="check-card {{ old('is_muslim') ? 'checked' : '' }}" id="card-mus" onclick="toggleCard(this,'mus')">
                    <input type="checkbox" name="is_muslim" value="1" id="cb-mus" {{ old('is_muslim') ? 'checked' : '' }} style="display:none;">
                    <div class="check-icon" id="icon-mus">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ old('is_muslim') ? '#054F31' : '#9ca3af' }}" style="width:18px;height:18px;" id="svg-mus"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:.85rem;font-weight:700;color:#111827;">مسلم/مسلمة</div>
                        <div style="font-size:.72rem;color:#9ca3af;">صاحب الشأن مسلم</div>
                    </div>
                </label>
            </div>

            {{-- Section: الملف --}}
            <div class="section-divider"><span>ملف السيرة الذاتية</span></div>

            <div class="field-group">
                <label class="field-label">ملف PDF <span class="req">*</span></label>
                <div class="drop-zone" id="dropZone"
                     onclick="document.getElementById('fileInput').click()"
                     ondragover="event.preventDefault();this.classList.add('drag')"
                     ondragleave="this.classList.remove('drag')"
                     ondrop="handleDrop(event)">
                    <div id="dropContent">
                        <div style="width:56px;height:56px;border-radius:16px;background:#f0fdf4;display:flex;align-items:center;justify-content:center;margin:0 auto .875rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:28px;height:28px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                        </div>
                        <div style="font-size:.9rem;font-weight:700;color:#111827;margin-bottom:.3rem;" id="fileLabel">اسحب الملف هنا أو اضغط للاختيار</div>
                        <div style="font-size:.75rem;color:#9ca3af;">PDF فقط — الحجم الأقصى 10 MB</div>
                    </div>
                    <input type="file" id="fileInput" name="file" accept="application/pdf" style="display:none;" onchange="updateLabel(this)">
                </div>
                @error('file') <div class="form-error" style="margin-top:.4rem;">{{ $message }}</div> @enderror
            </div>

        </div>{{-- end card body --}}
    </div>

    {{-- ════ SIDE PANEL ════ --}}
    <div style="display:flex;flex-direction:column;gap:1rem;position:sticky;top:1rem;">

        {{-- Actions --}}
        <div style="background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(0,0,0,.07);padding:1.4rem;">
            <div style="font-size:.82rem;font-weight:800;color:#374151;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                الإجراءات
            </div>
            <button type="submit" style="width:100%;background:linear-gradient(135deg,#054F31,#0a6b42);color:#fff;border:none;border-radius:12px;padding:.85rem;font-size:.9rem;font-weight:800;cursor:pointer;margin-bottom:.75rem;transition:opacity .15s;" onmouseover="this.style.opacity='.9'" onmouseout="this.style.opacity='1'">
                <div style="display:flex;align-items:center;justify-content:center;gap:.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                    رفع السيرة الذاتية
                </div>
            </button>
            <a href="{{ route('office.cvs.index') }}" style="display:block;text-align:center;background:#f9fafb;color:#374151;border:1.5px solid #e5e7eb;border-radius:12px;padding:.75rem;font-size:.85rem;font-weight:600;text-decoration:none;transition:background .15s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='#f9fafb'">
                إلغاء والعودة
            </a>
        </div>

        {{-- Tips --}}
        <div style="background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(0,0,0,.07);padding:1.4rem;">
            <div style="font-size:.82rem;font-weight:800;color:#374151;margin-bottom:.875rem;display:flex;align-items:center;gap:.5rem;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#f59e0b" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/></svg>
                تعليمات
            </div>
            @foreach(['يجب أن يكون الملف بصيغة PDF فقط', 'الحجم الأقصى للملف هو 10 ميجابايت', 'تأكد من صحة الجنسية والفئة المختارة', 'يمكنك تعديل البيانات لاحقاً'] as $tip)
            <div style="display:flex;align-items:flex-start;gap:.6rem;margin-bottom:.65rem;">
                <div style="width:20px;height:20px;border-radius:6px;background:#f0fdf4;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#054F31" style="width:11px;height:11px;"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                </div>
                <span style="font-size:.78rem;color:#6b7280;line-height:1.5;">{{ $tip }}</span>
            </div>
            @endforeach
        </div>
    </div>

</div>
</form>

@endsection

@push('scripts')
<script>
function toggleCard(el, key) {
    var cb = document.getElementById('cb-'+key);
    var icon = document.getElementById('icon-'+key);
    var svg = document.getElementById('svg-'+key);
    cb.checked = !cb.checked;
    if(cb.checked){
        el.classList.add('checked');
        icon.style.background='#d1fae5';
        svg.style.stroke='#054F31';
    } else {
        el.classList.remove('checked');
        icon.style.background='#f3f4f6';
        svg.style.stroke='#9ca3af';
    }
    return false;
}
function updateLabel(input) {
    if(input.files && input.files[0]){
        var f = input.files[0];
        var sz = (f.size/1024/1024).toFixed(1);
        document.getElementById('fileLabel').innerHTML =
            '<span style="color:#054F31;font-weight:700;">'+f.name+'</span>';
        document.getElementById('dropZone').classList.add('has-file');
        document.getElementById('dropContent').insertAdjacentHTML('beforeend',
            '<div style="display:inline-flex;align-items:center;gap:.4rem;margin-top:.5rem;background:#d1fae5;color:#065f46;border-radius:8px;padding:.25rem .7rem;font-size:.75rem;font-weight:600;">'+
            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>'+
            sz+' MB</div>');
    }
}
function handleDrop(e){
    e.preventDefault();
    document.getElementById('dropZone').classList.remove('drag');
    var files = e.dataTransfer.files;
    if(files.length){
        document.getElementById('fileInput').files = files;
        updateLabel(document.getElementById('fileInput'));
    }
}
</script>
@endpush
