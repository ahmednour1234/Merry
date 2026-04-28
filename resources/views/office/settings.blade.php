@extends('office.layouts.app')

@section('title', 'الإعدادات')

@push('styles')
<style>
    .sfield-group{margin-bottom:1.25rem}
    .sfield-label{display:block;font-size:.82rem;font-weight:700;color:#374151;margin-bottom:.4rem}
    .sfield-label .req{color:#ef4444;margin-right:2px}
    .sfield-input{width:100%;border:1.5px solid #e5e7eb;border-radius:10px;padding:.65rem .9rem;font-size:.875rem;color:#111827;outline:none;transition:border-color .15s,box-shadow .15s;background:#fff}
    .sfield-input:focus{border-color:#054F31;box-shadow:0 0 0 3px rgba(5,79,49,.08)}
    .s-divider{display:flex;align-items:center;gap:.75rem;margin:1.75rem 0 1.25rem}
    .s-divider span{font-size:.78rem;font-weight:800;color:#054F31;white-space:nowrap;background:#e8f5e9;padding:.3rem .75rem;border-radius:99px}
    .s-divider:before,.s-divider:after{content:'';flex:1;height:1px;background:#e5e7eb}
</style>
@endpush

@section('content')
<form method="POST" action="{{ route('office.settings.update') }}">
@csrf
<div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start;">

    {{-- Main Card --}}
    <div style="background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(0,0,0,.07);overflow:hidden;">

        {{-- Header --}}
        <div style="background:linear-gradient(135deg,#054F31 0%,#0a6b42 100%);padding:1.4rem 1.75rem;display:flex;align-items:center;gap:1rem;">
            <div style="width:46px;height:46px;border-radius:14px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:24px;height:24px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
            </div>
            <div>
                <div style="color:#fff;font-weight:800;font-size:1.05rem;">إعدادات الحساب</div>
                <div style="color:rgba(255,255,255,.6);font-size:.75rem;">تحديث بيانات مكتبك وكلمة المرور</div>
            </div>
        </div>

        {{-- Body --}}
        <div style="padding:1.75rem;">

            <div class="s-divider"><span>معلومات المكتب</span></div>

            <div class="sfield-group">
                <label class="sfield-label">اسم المكتب <span class="req">*</span></label>
                <input type="text" name="name" class="sfield-input" value="{{ old('name', $office->name) }}" required placeholder="أدخل اسم المكتب">
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div class="sfield-group">
                    <label class="sfield-label">البريد الإلكتروني <span class="req">*</span></label>
                    <input type="email" name="email" class="sfield-input" value="{{ old('email', $office->email) }}" required placeholder="example@domain.com">
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="sfield-group">
                    <label class="sfield-label">رقم الهاتف <span class="req">*</span></label>
                    <input type="text" name="phone" class="sfield-input" value="{{ old('phone', $office->phone) }}" required placeholder="+966 5x xxx xxxx">
                    @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="sfield-group">
                <label class="sfield-label">العنوان</label>
                <input type="text" name="address" class="sfield-input" value="{{ old('address', $office->address) }}" placeholder="المدينة، الحي، الشارع">
                @error('address') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="s-divider"><span>تغيير كلمة المرور</span></div>

            <div class="sfield-group">
                <label class="sfield-label">كلمة المرور الحالية</label>
                <div style="position:relative;">
                    <input type="password" name="current_password" id="cur-pw" class="sfield-input" autocomplete="current-password" placeholder="••••••••" style="padding-left:2.5rem;">
                    <button type="button" onclick="togglePw('cur-pw',this)" style="position:absolute;top:50%;left:.75rem;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#9ca3af;padding:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                    </button>
                </div>
                @error('current_password') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div class="sfield-group">
                    <label class="sfield-label">كلمة المرور الجديدة</label>
                    <div style="position:relative;">
                        <input type="password" name="password" id="new-pw" class="sfield-input" autocomplete="new-password" placeholder="••••••••" style="padding-left:2.5rem;">
                        <button type="button" onclick="togglePw('new-pw',this)" style="position:absolute;top:50%;left:.75rem;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#9ca3af;padding:0;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        </button>
                    </div>
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="sfield-group">
                    <label class="sfield-label">تأكيد كلمة المرور</label>
                    <div style="position:relative;">
                        <input type="password" name="password_confirmation" id="conf-pw" class="sfield-input" autocomplete="new-password" placeholder="••••••••" style="padding-left:2.5rem;">
                        <button type="button" onclick="togglePw('conf-pw',this)" style="position:absolute;top:50%;left:.75rem;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#9ca3af;padding:0;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Side Panel --}}
    <div style="display:flex;flex-direction:column;gap:1rem;position:sticky;top:1rem;">

        {{-- Save --}}
        <div style="background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(0,0,0,.07);padding:1.4rem;">
            <div style="font-size:.82rem;font-weight:800;color:#374151;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                الإجراءات
            </div>
            <button type="submit" style="width:100%;background:linear-gradient(135deg,#054F31,#0a6b42);color:#fff;border:none;border-radius:12px;padding:.85rem;font-size:.9rem;font-weight:800;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:.5rem;transition:opacity .15s;" onmouseover="this.style.opacity='.9'" onmouseout="this.style.opacity='1'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/></svg>
                حفظ الإعدادات
            </button>
        </div>

        {{-- Office Info Card --}}
        <div style="background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(0,0,0,.07);overflow:hidden;">
            <div style="background:linear-gradient(135deg,#054F31,#0a6b42);padding:1.1rem 1.25rem;display:flex;align-items:center;gap:.75rem;">
                <div style="width:46px;height:46px;border-radius:14px;background:rgba(255,255,255,.15);overflow:hidden;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    @if($office->image)
                        <img src="{{ $office->image_url }}" style="width:46px;height:46px;object-fit:cover;" alt="">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                    @endif
                </div>
                <div>
                    <div style="color:#fff;font-weight:800;font-size:.88rem;">{{ $office->name }}</div>
                    <div style="color:rgba(255,255,255,.6);font-size:.72rem;">{{ $office->email }}</div>
                </div>
            </div>
            <div style="padding:1rem 1.25rem;">
                @foreach([['label'=>'الهاتف','value'=>$office->phone,'icon'=>'M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 6v.75Z'],['label'=>'العنوان','value'=>$office->address ?: '—','icon'=>'M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z']] as $info)
                <div style="display:flex;align-items:flex-start;gap:.75rem;padding:.6rem 0;border-bottom:1px solid #f3f4f6;">
                    <div style="width:32px;height:32px;border-radius:9px;background:#f0fdf4;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:15px;height:15px;"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $info['icon'] }}"/></svg>
                    </div>
                    <div>
                        <div style="font-size:.7rem;color:#9ca3af;margin-bottom:.1rem;">{{ $info['label'] }}</div>
                        <div style="font-size:.82rem;font-weight:600;color:#111827;">{{ $info['value'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Security Tips --}}
        <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:18px;padding:1.25rem;">
            <div style="font-size:.8rem;font-weight:800;color:#92400e;margin-bottom:.75rem;display:flex;align-items:center;gap:.4rem;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#f59e0b" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                تنبيه أمني
            </div>
            @foreach(['استخدم كلمة مرور قوية لا تقل عن 8 أحرف', 'لا تشارك بيانات الدخول مع أحد', 'غيّر كلمة المرور بشكل دوري'] as $tip)
            <div style="display:flex;align-items:flex-start;gap:.5rem;margin-bottom:.5rem;">
                <div style="width:5px;height:5px;border-radius:50%;background:#f59e0b;flex-shrink:0;margin-top:6px;"></div>
                <span style="font-size:.77rem;color:#78350f;line-height:1.5;">{{ $tip }}</span>
            </div>
            @endforeach
        </div>

    </div>
</div>
</form>
@endsection

@push('scripts')
<script>
function togglePw(id, btn) {
    var inp = document.getElementById(id);
    if(inp.type === 'password') {
        inp.type = 'text';
        btn.style.color = '#054F31';
    } else {
        inp.type = 'password';
        btn.style.color = '#9ca3af';
    }
}
</script>
@endpush
