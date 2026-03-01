{{-- resources/views/filament/office/auth/login.blade.php --}}

<div dir="rtl">
    <div class="auth-page">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-card-inner">

                    {{-- Header --}}
                    <div class="auth-header">
                        <h1 class="app-name">تطبيق ميري</h1>
                        <p class="app-subtitle">للعمالة المنزلية</p>
                    </div>

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

                                {{-- Toggle LEFT --}}
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

                        {{-- Options row --}}
                        <div class="form-options">
                            <label class="remember-wrap" for="remember">
                                <input type="checkbox" wire:model="remember" id="remember">
                                <span>تذكرني</span>
                            </label>

                            <a href="#" class="forgot-password-link">نسيت كلمة المرور ؟</a>
                        </div>

                        <button type="submit" class="btn-submit">تسجيل الدخول</button>
                    </form>

                    <div class="divider"></div>

                    <div class="auth-link">
                        <a href="{{ \App\Filament\Office\Pages\Auth\Register::getUrl() }}">
                            ليس لديك حساب؟ إنشاء حساب جديد
                        </a>
                    </div>

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
        padding: 32px 18px;
        position: relative;
    }

    body::before{
        content:'';
        position: fixed;
        inset: 0;
        background:
            radial-gradient(circle at 20% 50%, rgba(5, 79, 49, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.03) 0%, transparent 50%);
        pointer-events:none;
        z-index:0;
    }

    .auth-page{
        width:100%;
        display:flex;
        align-items:center;
        justify-content:center;
        position:relative;
        z-index:1;
    }

    /* ✅ الحل: خلى الـ container أعرض */
    .auth-container{
        width:100%;
        max-width: 760px;   /* كان 520 */
        display:flex;
        align-items:center;
        justify-content:center;
    }

    /* ✅ الحل: خلى الكارد نفسه يأخذ مساحة أكبر */
    .auth-card{
        width: min(640px, 100%); /* كان 100% مع max صغير من container */
        background: var(--card);
        border-radius: 26px;
        box-shadow: var(--shadow-xl);
        border: 1px solid rgba(255,255,255,0.85);
        overflow:hidden;
        position:relative;
        backdrop-filter: blur(10px);
    }

    .auth-card::before{
        content:'';
        position:absolute;
        top:0; left:0; right:0;
        height: 4px;
        background: linear-gradient(90deg, var(--brand) 0%, var(--brand-light) 100%);
        opacity: .65;
    }

    /* ✅ الحل: padding متوازن زي الصورة */
    .auth-card-inner{
        padding: 56px 56px 44px;  /* كان 64 56 48 */
        text-align:center;
    }

    .auth-header{ margin-bottom: 18px; }

    .app-name{
        margin:0;
        font-size: 44px;
        font-weight: 900;
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-2) 100%);
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;
        background-clip:text;
        line-height: 1.15;
        letter-spacing: -0.6px;
    }

    .app-subtitle{
        margin: 10px 0 0;
        font-size: 16px;
        color: #64748b;
        font-weight: 600;
    }

    .auth-title{
        margin: 22px 0 26px;
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -0.2px;
    }

    .auth-form{
        text-align: right;
        margin-top: 6px;
    }

    .form-group{ margin-bottom: 18px; }

    .form-label{
        display:block;
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 700;
        color: #475569;
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
        outline:none;
        font-size: 15px;
        background: var(--field-bg);
        transition: all .25s ease;
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        text-align: right;
        color:#1e293b;
        font-weight: 500;
    }

    .form-input::placeholder{ color:#94a3b8; font-weight:400; }

    .form-input:hover{
        border-color:#cbd5e1;
        background:#fff;
    }

    .form-input:focus{
        border-color: var(--brand-2);
        box-shadow: 0 0 0 4px var(--focus), var(--shadow-md);
        background: var(--field-focus);
        transform: translateY(-1px);
    }

    .password-input-wrapper{ position:relative; }

    .password-input-wrapper .form-input{
        padding-left: 52px;
        padding-right: 16px;
    }

    .password-toggle{
        position:absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border:0;
        padding:8px;
        cursor:pointer;
        color: var(--brand);
        opacity:.75;
        border-radius: 8px;
        transition: all .2s ease;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .password-toggle:hover{
        opacity: 1;
        background: rgba(5,79,49,.08);
        transform: translateY(-50%) scale(1.05);
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
        font-weight: 800;
        font-size: 14px;
        color:#111827;
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
        font-weight: 700;
        font-size: 14px;
        white-space: nowrap;
        position: relative;
    }

    .forgot-password-link::after{
        content:'';
        position:absolute;
        bottom:-2px;
        left:0;
        width:0;
        height:2px;
        background: var(--brand-2);
        transition: width .25s ease;
    }

    .forgot-password-link:hover::after{ width:100%; }

    .btn-submit{
        margin-top: 22px;
        width:100%;
        height:56px;
        border-radius: 14px;
        border:0;
        cursor:pointer;
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-2) 100%);
        color:#fff;
        font-size: 17px;
        font-weight: 800;
        letter-spacing: .2px;
        font-family: 'Cairo', sans-serif;
        box-shadow: var(--shadow-md);
        transition: all .25s ease;
        position:relative;
        overflow:hidden;
    }

    .btn-submit:hover{
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        background: linear-gradient(135deg, #043f28 0%, var(--brand) 100%);
    }

    .divider{
        margin: 28px 0 18px;
        height:1px;
        background: linear-gradient(90deg, transparent, rgba(0,0,0,.08), transparent);
    }

    .auth-link{
        text-align:center;
        font-weight: 800;
        font-size: 14px;
    }

    .auth-link a{
        color: var(--brand-2);
        text-decoration:none;
        font-weight: 700;
        position: relative;
    }

    .auth-link a::after{
        content:'';
        position:absolute;
        bottom:-2px;
        left:0;
        width:0;
        height:2px;
        background: var(--brand-2);
        transition: width .25s ease;
    }

    .auth-link a:hover::after{ width:100%; }

    .error-message{
        display:block;
        margin-top: 8px;
        color: var(--danger);
        font-size: 13px;
        font-weight: 600;
        text-align:right;
        padding-right: 4px;
    }

    /* ✅ Responsive */
    @media (max-width: 640px){
        .auth-container{ max-width: 420px; }
        .auth-card{ width: 100%; }
        .auth-card-inner{ padding: 34px 18px 26px; }
        .app-name{ font-size: 34px; }
    }
</style>
@endpush
