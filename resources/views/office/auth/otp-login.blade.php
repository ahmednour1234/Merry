@extends('office.layouts.auth')
@section('title', 'التحقق من الرمز')

@section('shell-content')
<div class="auth-shell">

    {{-- LEFT: Form --}}
    <div class="auth-form-panel">
        <div class="auth-form-inner">

            <div class="form-page-title">تحقق من بريدك الإلكتروني</div>
            <div class="form-page-sub">لقد أرسلنا رمز التحقق إلى<br><strong style="color:#054F31;">{{ $maskedEmail ?? 'بريدك الإلكتروني' }}</strong></div>

            @if(session('error'))  <div class="alert alert-error" style="margin-top:1rem;">{{ session('error') }}</div> @endif
            @if(session('success')) <div class="alert alert-success" style="margin-top:1rem;">{{ session('success') }}</div> @endif

            <form method="POST" action="{{ route('office.otp.verify') }}" id="otpForm" style="margin-top:1.5rem;">
                @csrf
                <label class="form-label" style="text-align:center;display:block;margin-bottom:0.75rem;">أدخل رمز التحقق المكون من 4 أرقام</label>
                <div class="otp-boxes" id="otpBoxes">
                    @for($i=0;$i<4;$i++)
                    <input class="otp-box" type="text" inputmode="numeric" maxlength="1" data-index="{{ $i }}">
                    @endfor
                </div>
                <input type="hidden" name="otp" id="otpHidden">

                @error('otp') <div class="form-error" style="text-align:center;margin-bottom:0.75rem;">{{ $message }}</div> @enderror

                @if(app()->environment(['local','dev','development','staging','testing']) || config('app.debug'))
                    <div style="text-align:center;font-size:0.75rem;color:#9ca3af;margin-bottom:0.75rem;">رمز التطوير: <strong>1111</strong></div>
                @endif

                <div style="text-align:center;font-size:0.82rem;color:#9ca3af;margin-bottom:1.25rem;">
                    لم تصلك الرسالة؟
                    <form method="POST" action="{{ route('office.otp.resend') }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none;border:none;color:#054F31;font-weight:700;cursor:pointer;font-family:'Cairo',sans-serif;font-size:0.82rem;">إعادة إرسال الرمز</button>
                    </form>
                </div>

                <button type="submit" class="btn-primary" onclick="collectOtp()">تحقق</button>
            </form>

            <div class="auth-link-row"><a href="{{ route('office.login') }}">← العودة لتسجيل الدخول</a></div>
        </div>
    </div>

    {{-- RIGHT: Brand --}}
    <div class="auth-brand-panel">
        <div class="brand-logo">
            <img src="{{ asset('images/merry-logo.png') }}" alt="ميري">
        </div>
        <div class="brand-title">نظام ميري</div>
        <div class="brand-sub">إدارة طلبات الاستقدام<br>بكفاءة واحترافية</div>
        <ul class="brand-features">
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg></span>التحقق الآمن من الهوية</li>
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg></span>إدارة السير الذاتية</li>
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg></span>تقارير واحصائيات</li>
            <li><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg></span>اشتراكات مرنة</li>
        </ul>
    </div>

</div>
@endsection

@push('scripts')
<script>
const boxes = document.querySelectorAll('.otp-box');
boxes.forEach((box, i) => {
    box.addEventListener('input', () => {
        box.value = box.value.replace(/\D/g,'').slice(-1);
        if (box.value && i < boxes.length - 1) boxes[i+1].focus();
    });
    box.addEventListener('keydown', e => {
        if (e.key === 'Backspace' && !box.value && i > 0) boxes[i-1].focus();
    });
});
function collectOtp() {
    document.getElementById('otpHidden').value = [...boxes].map(b => b.value).join('');
}
</script>
@endpush
