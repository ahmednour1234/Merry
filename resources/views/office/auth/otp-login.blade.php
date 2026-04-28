@extends('office.layouts.auth')
@section('title', 'التحقق من الرمز')

@section('shell-content')
<div class="auth-shell single-col">
<div class="auth-card-solo">

    <div class="solo-logo">
        <div class="solo-logo-wrap">
            <img src="{{ asset('images/merry-logo.png') }}" alt="مري">
        </div>
        <div class="solo-title">تحقق من بريدك الإلكتروني</div>
        <div class="solo-sub">لقد أرسلنا رمز التحقق إلى البريد الإلكتروني<br><strong style="color:#054F31;">{{ $maskedEmail ?? '' }}</strong></div>
    </div>

    @if(session('error'))  <div class="alert alert-error">{{ session('error') }}</div> @endif
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <form method="POST" action="{{ route('office.otp.verify') }}" id="otpForm">
        @csrf
        <label class="form-label" style="text-align:center;display:block;margin-bottom:0.5rem;">أدخل رمز التحقق</label>
        <div class="otp-boxes" id="otpBoxes">
            @for($i=0;$i<6;$i++)
            <input class="otp-box" type="text" inputmode="numeric" maxlength="1" data-index="{{ $i }}">
            @endfor
        </div>
        <input type="hidden" name="otp" id="otpHidden">

        @error('otp') <div class="form-error" style="text-align:center;margin-bottom:0.75rem;">{{ $message }}</div> @enderror

        @if(app()->environment(['local','dev','development','staging','testing']))
            <div style="text-align:center;font-size:0.75rem;color:#9ca3af;margin-bottom:0.75rem;">رمز التطوير: <strong>111111</strong></div>
        @endif

        <div style="text-align:center;font-size:0.8rem;color:#9ca3af;margin-bottom:1rem;">
            لم تصلك الرسالة؟
            <form method="POST" action="{{ route('office.otp.resend') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:none;border:none;color:#054F31;font-weight:700;cursor:pointer;font-family:'Cairo',sans-serif;font-size:0.8rem;">إعادة إرسال الرمز خلال 00:45</button>
            </form>
        </div>

        <button type="submit" class="btn-primary" onclick="collectOtp()">تحقق</button>
    </form>

    <div class="auth-link-row"><a href="{{ route('office.login') }}">← العودة</a></div>
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
