{{-- resources/views/filament/office/auth/login.blade.php --}}

<div dir="rtl">
    <div class="auth-page">
        <div class="auth-container">
            <div class="auth-card">

                {{-- Header --}}
                <div class="auth-header">
                    <h1 class="app-name">تطبيق ميري</h1>
                    <p class="app-subtitle">للعمالة المنزلية</p>
                </div>

                {{-- Title (Right aligned like screenshot) --}}
                <div class="auth-title-wrap">
                    <h2 class="auth-title">تسجيل الدخول</h2>
                </div>

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
                            >

                            {{-- Toggle on LEFT (like screenshot) --}}
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

                    {{-- Options (Forgot LEFT, Remember RIGHT) --}}
                    <div class="form-options">
                        <a href="#" class="forgot-password-link">نسيت كلمة المرور ؟</a>

                        <label class="remember-wrap" for="remember">
                            <span>تذكرني</span>
                            <input type="checkbox" wire:model="remember" id="remember">
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-submit">تسجيل الدخول</button>
                </form>

                {{-- Register link --}}
                <div class="auth-link">
                    <a href="{{ \App\Filament\Office\Pages\Auth\Register::getUrl() }}">
                        ليس لديك حساب؟ إنشاء حساب جديد
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root{
        --brand: #054F31;
        --brand-2: #0a6b44;
        --muted: #6b7280;
        --border: #dfe6e9;
        --bg: #f3f6f7;
        --danger: #ef4444;
        --focus: rgba(5, 79, 49, 0.12);
    }

    *{ box-sizing:border-box; }
    html,body{ margin:0; padding:0; }

    body{
        font-family: 'Cairo', sans-serif;
        background: var(--bg);
        min-height: 100vh;
        display:flex;
        align-items:center;
        justify-content:center;
        padding: 24px;
        overflow-x:hidden;
    }

    .auth-page{
        width:100%;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .auth-container{
        width:100%;
        max-width: 760px; /* similar to screenshot */
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .auth-card{
        width:100%;
        background:#fff;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        padding: 54px 54px 44px;
    }

    .auth-header{
        text-align:center;
        margin-bottom: 26px;
    }

    .app-name{
        margin:0;
        font-size: 34px;
        font-weight: 800;
        color: #111827;
        letter-spacing: .2px;
    }

    .app-subtitle{
        margin:10px 0 0;
        font-size: 16px;
        color: #111827;
        font-weight: 600;
        opacity: .75;
    }

    .auth-title-wrap{
        margin-top: 10px;
        margin-bottom: 18px;
        text-align: right; /* title right like screenshot */
    }

    .auth-title{
        margin:0;
        font-size: 18px;
        font-weight: 800;
        color: #111827;
    }

    .auth-form{ margin-top: 6px; }

    .form-group{
        margin-bottom: 22px;
    }

    .form-label{
        display:block;
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 800;
        color: var(--brand-2); /* green label like screenshot */
    }

    .form-label.required::after{
        content:" *";
        color: var(--danger);
        font-weight: 900;
    }

    .form-input{
        width:100%;
        height: 48px;
        padding: 0 16px;
        border: 1px solid #cfd8dc;
        border-radius: 10px;
        outline:none;
        font-size: 14px;
        background:#fff;
        transition: .2s ease;
        direction: rtl;
        text-align: right;
        font-family: 'Cairo', sans-serif;
    }

    .form-input:focus{
        border-color: var(--brand-2);
        box-shadow: 0 0 0 4px var(--focus);
    }

    .password-input-wrapper{
        position:relative;
    }

    /* Toggle on LEFT for RTL (like screenshot) */
    .password-toggle{
        position:absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: 0;
        padding: 6px;
        cursor:pointer;
        color: var(--brand);
        opacity: .9;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .password-toggle:hover{
        opacity: 1;
    }

    /* add space for icon on left */
    .password-input-wrapper .form-input{
        padding-left: 52px;
        padding-right: 16px;
    }

    .form-options{
        margin-top: 6px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap: 16px;
    }

    .forgot-password-link{
        color: var(--brand-2);
        text-decoration:none;
        font-weight: 800;
        font-size: 13px;
    }

    .forgot-password-link:hover{
        text-decoration: underline;
    }

    .remember-wrap{
        display:flex;
        align-items:center;
        gap: 10px;
        font-weight: 800;
        font-size: 13px;
        color: #111827;
        cursor:pointer;
        user-select:none;
    }

    .remember-wrap input[type="checkbox"]{
        width: 18px;
        height: 18px;
        accent-color: var(--brand);
        cursor:pointer;
    }

    .btn-submit{
        margin-top: 18px;
        width:100%;
        height: 52px;
        border-radius: 10px;
        border:0;
        cursor:pointer;
        background: var(--brand); /* dark green button like screenshot */
        color:#fff;
        font-size: 16px;
        font-weight: 900;
        letter-spacing: .2px;
        transition: .2s ease;
        font-family: 'Cairo', sans-serif;
    }

    .btn-submit:hover{
        background: #043f28;
    }

    .auth-link{
        margin-top: 22px;
        text-align:center;
        padding-top: 18px;
        border-top: 1px solid rgba(0,0,0,0.08);
    }

    .auth-link a{
        color: var(--brand-2);
        text-decoration:none;
        font-weight: 800;
        font-size: 13px;
    }

    .auth-link a:hover{
        text-decoration: underline;
    }

    .error-message{
        display:block;
        margin-top: 8px;
        color: var(--danger);
        font-size: 12.5px;
        font-weight: 700;
    }

    /* Responsive */
    @media (max-width: 640px){
        body{ padding: 14px; }
        .auth-card{ padding: 28px 18px; }
        .app-name{ font-size: 28px; }
        .app-subtitle{ font-size: 14px; }
    }
</style>
@endpush
