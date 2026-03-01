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
</div>

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap');

    :root {
        --brand: #054F31;
        --brand-dark: #043f28;
        --brand-light: #0a6b44;
        --brand-lighter: #10b981;
        --bg: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f8fafc 100%);
        --card: #ffffff;
        --muted: #64748b;
        --border: #e2e8f0;
        --field-bg: #f8fafc;
        --field-focus: #f0f9ff;
        --danger: #ef4444;
        --focus: rgba(5, 79, 49, 0.15);
        --text-primary: #1e293b;
        --text-secondary: #475569;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    html, body {
        height: 100%;
    }

    body {
        font-family: 'Cairo', sans-serif;
        background: var(--bg);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at center, rgba(5, 79, 49, 0.02) 0%, transparent 70%);
        animation: rotate 30s linear infinite;
        pointer-events: none;
    }

    @keyframes rotate {
        to { transform: rotate(360deg); }
    }

    .auth-page {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
        min-height: 100vh;
    }

    .auth-container {
        width: 100%;
        max-width: 550px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-card {
        width: 100%;
        aspect-ratio: 1;
        max-width: 550px;
        background: var(--card);
        border-radius: 32px;
        box-shadow: 0 30px 60px -12px rgba(5, 79, 49, 0.25), 0 0 0 1px rgba(255, 255, 255, 0.95);
        overflow: hidden;
        position: relative;
        backdrop-filter: blur(20px);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }

    .auth-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 40px 80px -16px rgba(5, 79, 49, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.95);
    }

    .auth-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--brand) 0%, var(--brand-light) 50%, var(--brand-lighter) 100%);
        animation: shimmer 3s ease-in-out infinite;
        z-index: 1;
    }

    .auth-card::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(5, 79, 49, 0.03) 0%, transparent 70%);
        animation: pulse 8s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes shimmer {
        0%, 100% { opacity: 0.9; }
        50% { opacity: 1; }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .auth-card-inner {
        padding: 50px 45px 45px;
        text-align: center;
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        justify-content: center;
        flex: 1;
        overflow-y: auto;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 24px;
    }

    .app-name {
        font-size: 42px;
        font-weight: 900;
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 50%, var(--brand-lighter) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.5px;
        line-height: 1.1;
        margin-bottom: 6px;
    }

    .app-subtitle {
        font-size: 16px;
        color: var(--muted);
        font-weight: 600;
        letter-spacing: 0.3px;
        margin-top: 4px;
    }

    .auth-title {
        margin: 20px 0 24px;
        font-size: 24px;
        font-weight: 800;
        color: var(--text-primary);
        text-align: center;
        letter-spacing: -0.2px;
    }

    .auth-form {
        margin-top: 8px;
        text-align: right;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        margin-bottom: 12px;
        font-size: 15px;
        font-weight: 700;
        color: var(--text-secondary);
        letter-spacing: 0.2px;
        text-align: right;
    }

    .form-label.required::after {
        content: " *";
        color: var(--danger);
        font-weight: 900;
    }

    .form-input {
        width: 100%;
        height: 52px;
        padding: 0 18px;
        border: 2px solid var(--border);
        border-radius: 12px;
        outline: none;
        font-size: 15px;
        background: var(--field-bg);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        text-align: right;
        color: var(--text-primary);
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

    .form-input:focus {
        border-color: var(--brand);
        box-shadow: 0 0 0 4px var(--focus), 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        background: var(--field-focus);
        transform: translateY(-1px);
    }

    .password-input-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: 0;
        padding: 10px;
        cursor: pointer;
        color: var(--brand);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0.7;
        transition: all 0.2s ease;
        border-radius: 8px;
    }

    .password-toggle:hover {
        opacity: 1;
        background: rgba(5, 79, 49, 0.08);
        transform: translateY(-50%) scale(1.05);
    }

    .password-input-wrapper .form-input {
        padding-left: 56px;
        padding-right: 18px;
    }

    .form-options {
        margin-top: 6px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 20px;
    }

    .remember-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        font-size: 15px;
        color: var(--text-primary);
        cursor: pointer;
        user-select: none;
        transition: color 0.2s ease;
    }

    .remember-wrap:hover {
        color: var(--brand);
    }

    .remember-wrap input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: var(--brand);
        cursor: pointer;
        transition: transform 0.2s ease;
        border-radius: 4px;
    }

    .remember-wrap:hover input[type="checkbox"] {
        transform: scale(1.1);
    }

    .forgot-password-link {
        color: var(--brand);
        text-decoration: none;
        font-weight: 700;
        font-size: 15px;
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
        background: var(--brand);
        transition: width 0.3s ease;
    }

    .forgot-password-link:hover {
        color: var(--brand-dark);
    }

    .forgot-password-link:hover::after {
        width: 100%;
    }

    .btn-submit {
        margin-top: 20px;
        width: 100%;
        height: 54px;
        border-radius: 14px;
        border: 0;
        cursor: pointer;
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
        color: #fff;
        font-size: 17px;
        font-weight: 800;
        letter-spacing: 0.3px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-family: 'Cairo', sans-serif;
        box-shadow: 0 8px 16px -4px rgba(5, 79, 49, 0.3);
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, var(--brand-dark) 0%, var(--brand) 100%);
        transform: translateY(-2px);
        box-shadow: 0 12px 24px -6px rgba(5, 79, 49, 0.4);
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:active {
        transform: translateY(0);
        box-shadow: 0 4px 8px -2px rgba(5, 79, 49, 0.3);
    }

    .divider {
        margin: 24px 0 20px;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.1), transparent);
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, var(--brand-light), var(--brand-lighter));
        opacity: 0.4;
    }

    .auth-link {
        text-align: center;
        font-size: 15px;
    }

    .auth-link a {
        color: var(--brand);
        text-decoration: none;
        font-weight: 700;
        transition: all 0.2s ease;
        position: relative;
        display: inline-block;
    }

    .auth-link a::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--brand);
        transition: width 0.3s ease;
    }

    .auth-link a:hover {
        color: var(--brand-dark);
        transform: translateY(-1px);
    }

    .auth-link a:hover::after {
        width: 100%;
    }

    .error-message {
        display: block;
        margin-top: 10px;
        color: var(--danger);
        font-size: 14px;
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

    @media (max-width: 768px) {
        .auth-container {
            max-width: 480px;
        }

        .auth-card {
            max-width: 480px;
        }

        .auth-card-inner {
            padding: 45px 35px 35px;
        }

        .app-name {
            font-size: 38px;
        }
    }

    @media (max-width: 480px) {
        body {
            padding: 16px;
        }

        .auth-container {
            max-width: 100%;
        }

        .auth-card {
            max-width: 100%;
            border-radius: 24px;
            aspect-ratio: auto;
            min-height: auto;
        }

        .auth-card-inner {
            padding: 35px 24px 30px;
        }

        .app-name {
            font-size: 32px;
        }

        .app-subtitle {
            font-size: 15px;
        }

        .auth-title {
            font-size: 20px;
            margin: 18px 0 20px;
        }

        .form-input {
            height: 50px;
            font-size: 14px;
        }

        .btn-submit {
            height: 52px;
            font-size: 16px;
        }

        .form-options {
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .remember-wrap {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush
