{{-- resources/views/filament/office/auth/login.blade.php --}}

<div dir="rtl">
    <div class="auth-page">
        <div class="auth-container">
            <div class="auth-card">

                {{-- ✅ Inner padding wrapper (controls padding of everything inside the card) --}}
                <div class="auth-card-inner">

                    {{-- Header --}}
                    <div class="auth-header">
                        <h1 class="app-name">تطبيق ميري</h1>
                        <p class="app-subtitle">للعمالة المنزلية</p>
                    </div>

                    {{-- Title --}}
                    <h2 class="auth-title">تسجيل الدخول</h2>

                    <form wire:submit="authenticate" class="auth-form">
                        {{-- Email --}}
                        <div class="form-group">
                            <label class="form-label required">عنوان البريد الإلكتروني</label>
                            <input
                                type="email"
                                wire:model="email"
                                class="form-input"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="admin@example.com"
                            >
                            @error('email') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        {{-- Password --}}
                        <div class="form-group">
                            <label class="form-label required">كلمة المرور</label>

                            <div class="password-input-wrapper">
                                <input
                                    type="{{ $showPassword ? 'text' : 'password' }}"
                                    wire:model="password"
                                    class="form-input"
                                    required
                                    autocomplete="current-password"
                                    placeholder="••••••••"
                                >

                                {{-- Toggle (LEFT like screenshot) --}}
                                <button
                                    type="button"
                                    wire:click="togglePassword"
                                    class="password-toggle"
                                    aria-label="Toggle password"
                                >
                                    <svg wire:ignore xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        @if($showPassword)
                                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                            <line x1="1" y1="1" x2="23" y2="23"></line>
                                        @else
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        @endif
                                    </svg>
                                </button>
                            </div>

                            @error('password') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        {{-- Options row (Remember LEFT, Forgot RIGHT) --}}
                        <div class="form-options">
                            <label class="remember-wrap" for="remember">
                                <input type="checkbox" wire:model="remember" id="remember">
                                <span>تذكرني</span>
                            </label>

                            <a href="#" class="forgot-password-link">نسيت كلمة المرور ؟</a>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="btn-submit">
                            تسجيل الدخول
                        </button>
                    </form>

                    {{-- Divider --}}
                    <div class="divider"></div>

                    {{-- Register link --}}
                    <div class="auth-link">
                        <a href="{{ \App\Filament\Office\Pages\Auth\Register::getUrl() }}">
                            ليس لديك حساب؟ إنشاء حساب جديد
                        </a>
                    </div>

                </div>{{-- /auth-card-inner --}}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root{
        --brand: #054F31;
        --brand-2: #0a6b44;
        --brand-light: #10b981;
        --bg: linear-gradient(135deg, #f5f7fa 0%, #e8f0f5 50%, #f0f4f8 100%);
        --card: #ffffff;
        --muted: #6b7280;
        --border: #e2e8f0;
        --field-bg: #f8fafc;
        --field-focus: #f0f9ff;
        --danger: #ef4444;
        --focus: rgba(5, 79, 49, 0.12);
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    *{ box-sizing:border-box; }
    html,body{ margin:0; padding:0; }

    body{
        font-family: 'Cairo', sans-serif;
        background: var(--bg);
        background-attachment: fixed;
        min-height: 100vh;
        display:flex;
        align-items:center;
        justify-content:center;
        padding: 24px;
        position: relative;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(circle at 20% 50%, rgba(5, 79, 49, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.03) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    .auth-page{
        width:100%;
        display:flex;
        align-items:center;
        justify-content:center;
        position: relative;
        z-index: 1;
    }

    .auth-container{
        width:100%;
        max-width: 520px;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    /* ✅ Card itself (outer shell) */
    .auth-card{
        width:100%;
        background: var(--card);
        border-radius: 24px;
        box-shadow: var(--shadow-xl);
        border: 1px solid rgba(255, 255, 255, 0.8);
        padding: 0;
        overflow: hidden;
        position: relative;
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .auth-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--brand) 0%, var(--brand-light) 100%);
        opacity: 0.6;
    }

    /* ✅ HERE: padding for the content inside the card */
    .auth-card-inner{
        padding: 64px 56px 48px;
        text-align: center;
        position: relative;
    }

    .auth-header{
        text-align:center;
        margin-bottom: 22px;
    }

    .app-name{
        margin:0;
        font-size: 42px;
        font-weight: 900;
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-2) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.5px;
        line-height: 1.2;
        text-shadow: 0 2px 4px rgba(5, 79, 49, 0.1);
    }

    .app-subtitle{
        margin: 12px 0 0;
        font-size: 16px;
        color: #64748b;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .auth-title{
        margin: 24px 0 28px;
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
        text-align: center;
        letter-spacing: -0.3px;
    }

    .auth-form{
        margin-top: 6px;
        text-align: right;
    }

    .form-group{
        margin-bottom: 18px;
    }

    .form-label{
        display:block;
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 700;
        color: #475569;
        letter-spacing: 0.2px;
    }

    .form-label.required::after{
        content:" *";
        color: var(--danger);
        font-weight: 900;
    }

    .form-input{
        width: 100%;
        height: 54px;
        padding: 0 18px;
        border: 2px solid var(--border);
        border-radius: 14px;
        outline: none;
        font-size: 15px;
        background: var(--field-bg);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        text-align: right;
        color: #1e293b;
        font-weight: 500;
    }

    .form-input::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }

    .form-input:hover {
        border-color: #cbd5e1;
        background: #ffffff;
    }

    .form-input:focus{
        border-color: var(--brand-2);
        box-shadow: 0 0 0 4px var(--focus), var(--shadow-md);
        background: var(--field-focus);
        transform: translateY(-1px);
    }

    .password-input-wrapper{
        position: relative;
    }

    .password-toggle{
        position:absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: 0;
        padding: 8px;
        cursor: pointer;
        color: var(--brand);
        display:flex;
        align-items:center;
        justify-content:center;
        opacity: 0.7;
        transition: all 0.2s ease;
        border-radius: 6px;
    }

    .password-toggle:hover {
        opacity: 1;
        background: rgba(5, 79, 49, 0.08);
        transform: translateY(-50%) scale(1.1);
    }

    .password-input-wrapper .form-input{
        padding-left: 52px;
        padding-right: 16px;
    }

    .form-options{
        margin-top: 6px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap: 14px;
    }

    .remember-wrap{
        display:flex;
        align-items:center;
        gap: 10px;
        font-weight: 900;
        font-size: 14px;
        color: #111827;
        cursor:pointer;
        user-select:none;
    }

    .remember-wrap input[type="checkbox"]{
        width: 18px;
        height: 18px;
        accent-color: var(--brand);
        cursor:pointer;
        transition: transform 0.2s ease;
    }

    .remember-wrap:hover input[type="checkbox"] {
        transform: scale(1.1);
    }

    .forgot-password-link{
        color: var(--brand-2);
        text-decoration:none;
        font-weight: 700;
        font-size: 14px;
        white-space: nowrap;
        transition: all 0.2s ease;
        position: relative;
    }

    .forgot-password-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--brand-2);
        transition: width 0.3s ease;
    }

    .forgot-password-link:hover {
        color: var(--brand);
    }

    .forgot-password-link:hover::after {
        width: 100%;
    }

    .btn-submit{
        margin-top: 24px;
        width: 100%;
        height: 56px;
        border-radius: 14px;
        border: 0;
        cursor: pointer;
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-2) 100%);
        color: #fff;
        font-size: 17px;
        font-weight: 800;
        letter-spacing: 0.3px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-family: 'Cairo', sans-serif;
        box-shadow: var(--shadow-md);
        position: relative;
        overflow: hidden;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #043f28 0%, var(--brand) 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:active {
        transform: translateY(0);
        box-shadow: var(--shadow-sm);
    }

    .divider{
        margin: 28px 0 20px;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(0,0,0,0.08), transparent);
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 1px;
        background: var(--brand-2);
        opacity: 0.3;
    }

    .auth-link{
        text-align: center;
        font-weight: 900;
        font-size: 14px;
    }

    .auth-link a{
        color: var(--brand-2);
        text-decoration:none;
        font-weight: 700;
        transition: all 0.2s ease;
        position: relative;
        display: inline-block;
    }

    .auth-link a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--brand-2);
        transition: width 0.3s ease;
    }

    .auth-link a:hover {
        color: var(--brand);
        transform: translateY(-1px);
    }

    .auth-link a:hover::after {
        width: 100%;
    }

    .error-message{
        display:block;
        margin-top: 8px;
        color: var(--danger);
        font-size: 13px;
        font-weight: 600;
        text-align: right;
        padding-right: 4px;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 480px){
        body{ padding: 14px; }
        .auth-container{ max-width: 360px; }
        .auth-card-inner{ padding: 34px 18px 24px; }
        .app-name{ font-size: 34px; }
    }
</style>
@endpush
