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

                    {{-- Options row (Remember LEFT, Forgot RIGHT like screenshot) --}}
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

            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root{
        --brand: #054F31;
        --brand-2: #0a6b44;
        --bg: #eef2f3;
        --card: #ffffff;
        --muted: #6b7280;
        --border: #d3dbe0;
        --field-bg: #eaf2ff;   /* ✅ نفس اللون الأزرق الفاتح */
        --danger: #ef4444;
        --focus: rgba(5, 79, 49, 0.16);
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
    }

    .auth-page{
        width:100%;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    /* ✅ Card أنحف زي الصورة */
    .auth-container{
        width:100%;
        max-width: 420px;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .auth-card{
        width:100%;
        background: var(--card);
        border-radius: 18px;
        box-shadow: 0 18px 40px rgba(0,0,0,0.08);
        padding: 44px 34px 30px;
        text-align: center;
    }

    .auth-header{
        text-align:center;
        margin-bottom: 22px;
    }

    .app-name{
        margin:0;
        font-size: 40px;
        font-weight: 900;
        color: #111827;
        letter-spacing: .2px;
        line-height: 1.1;
    }

    .app-subtitle{
        margin: 10px 0 0;
        font-size: 16px;
        color: #111827;
        font-weight: 700;
        opacity: .70;
    }

    .auth-title{
        margin: 18px 0 18px;
        font-size: 20px;
        font-weight: 900;
        color: #111827;
        text-align: center;
    }

    .auth-form{
        margin-top: 6px;
        text-align: right; /* labels right */
    }

    .form-group{
        margin-bottom: 18px;
    }

    .form-label{
        display:block;
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 900;
        color: var(--brand-2);
    }

    .form-label.required::after{
        content:" *";
        color: var(--danger);
        font-weight: 900;
    }

    /* ✅ Inputs أصغر + لون أزرق فاتح + نص بالوسط زي الصورة */
    .form-input{
        width: 100%;
        height: 52px;
        padding: 0 16px;
        border: 1px solid var(--border);
        border-radius: 12px;
        outline: none;
        font-size: 14px;
        background: var(--field-bg);
        transition: .2s ease;
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        text-align: center; /* ✅ زي الصورة */
        color: #111827;
    }

    .form-input:focus{
        border-color: var(--brand-2);
        box-shadow: 0 0 0 4px var(--focus);
        background: #edf5ff;
    }

    .password-input-wrapper{
        position: relative;
    }

    /* ✅ أيقونة العين على الشمال داخل الحقل */
    .password-toggle{
        position:absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: 0;
        padding: 6px;
        cursor: pointer;
        color: var(--brand);
        display:flex;
        align-items:center;
        justify-content:center;
        opacity: .95;
    }

    .password-toggle:hover{
        opacity: 1;
    }

    /* مساحة للأيقونة */
    .password-input-wrapper .form-input{
        padding-left: 52px;
        padding-right: 16px;
    }

    /* ✅ Row: checkbox LEFT, forgot RIGHT */
    .form-options{
        margin-top: 6px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap: 14px;
        text-align: right;
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
    }

    .forgot-password-link{
        color: var(--brand-2);
        text-decoration:none;
        font-weight: 900;
        font-size: 14px;
        white-space: nowrap;
    }

    .forgot-password-link:hover{
        text-decoration: underline;
    }

    /* ✅ زر بحواف دائرية كبير زي الصورة */
    .btn-submit{
        margin-top: 18px;
        width: 100%;
        height: 56px;
        border-radius: 12px;
        border: 0;
        cursor: pointer;
        background: var(--brand);
        color: #fff;
        font-size: 18px;
        font-weight: 900;
        transition: .2s ease;
        font-family: 'Cairo', sans-serif;
    }

    .btn-submit:hover{
        background: #043f28;
    }

    .divider{
        margin: 22px 0 18px;
        height: 1px;
        background: rgba(0,0,0,0.06);
    }

    .auth-link{
        text-align: center;
        font-weight: 900;
        font-size: 14px;
    }

    .auth-link a{
        color: var(--brand-2);
        text-decoration:none;
        font-weight: 900;
    }

    .auth-link a:hover{
        text-decoration: underline;
    }

    .error-message{
        display:block;
        margin-top: 8px;
        color: var(--danger);
        font-size: 12.5px;
        font-weight: 800;
        text-align: right;
    }

    @media (max-width: 480px){
        body{ padding: 14px; }
        .auth-container{ max-width: 360px; }
        .auth-card{ padding: 34px 18px 24px; }
        .app-name{ font-size: 34px; }
    }
</style>
@endpush
