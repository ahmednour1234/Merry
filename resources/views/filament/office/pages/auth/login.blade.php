<div dir="rtl">
    <div class="auth-container">
        <div class="auth-card">
            <h1 class="app-name">تطبيق ميري</h1>
            <p class="app-subtitle">للعمالة المنزلية</p>
            <form wire:submit="authenticate">
                <div class="form-group">
                    <label class="form-label required">عنوان البريد الالكتروني</label>
                    <input
                        type="email"
                        wire:model="email"
                        class="form-input"
                        required
                        autofocus
                    >
                    @error('email') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">كلمة المرور</label>
                    <div class="password-input-wrapper">
                        <input
                            type="{{ $showPassword ? 'text' : 'password' }}"
                            wire:model="password"
                            class="form-input"
                            required
                        >
                        <button
                            type="button"
                            wire:click="togglePassword"
                            class="password-toggle"
                        >
                            <svg wire:ignore xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

                <div class="form-options">
                    <a href="#" class="forgot-password-link">نسيت كلمة المرور ؟</a>
                    <div class="form-checkbox">
                        <input
                            type="checkbox"
                            wire:model="remember"
                            id="remember"
                        >
                        <label for="remember">تذكرني</label>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    تسجيل الدخول
                </button>
            </form>

            <div class="auth-link">
                <a href="{{ \App\Filament\Office\Pages\Auth\Register::getUrl() }}">
                    ليس لديك حساب؟ إنشاء حساب جديد
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    * {
        box-sizing: border-box;
    }

    html, body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    body {
        background: linear-gradient(135deg, #f0f4f8 0%, #e8f0f5 100%);
        min-height: 100vh;
        padding: 20px;
        font-family: 'Cairo', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .auth-container {
        max-width: 600px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .app-name {
        font-size: 36px;
        font-weight: 700;
        color: #054F31;
        margin: 0 0 12px 0;
    }

    .app-subtitle {
        font-size: 18px;
        color: #666;
        margin: 0 0 30px 0;
    }

    .auth-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 50px;
        width: 100%;
        text-align: right;
        overflow: hidden;
        max-width: 100%;
    }

    .app-name {
        text-align: center;
    }

    .app-subtitle {
        text-align: center;
    }

    .auth-title {
        font-size: 24px;
        font-weight: 700;
        color: #054F31;
        text-align: center;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 28px;
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: #333;
        font-size: 15px;
        text-align: right;
    }

    .form-label.required::after {
        content: ' *';
        color: #ef4444;
    }

    .form-input {
        width: 100%;
        padding: 16px 18px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s;
        font-family: 'Cairo', sans-serif;
        text-align: right;
        direction: rtl;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .password-input-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 14px;
        left: auto;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #6b7280;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .password-toggle:hover {
        color: #054F31;
    }

    .password-input-wrapper .form-input {
        padding-right: 50px;
        padding-left: 18px;
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        flex-direction: row-reverse;
        gap: 15px;
    }

    .forgot-password-link {
        color: #10b981;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
    }

    .forgot-password-link:hover {
        text-decoration: underline;
    }

    .form-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-checkbox input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #10b981;
    }

    .form-checkbox label {
        font-size: 14px;
        color: #333;
        cursor: pointer;
        margin: 0;
    }

    .btn-submit {
        width: 100%;
        padding: 18px;
        background: #10b981;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 17px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        font-family: 'Cairo', sans-serif;
        box-sizing: border-box;
    }

    .btn-submit:hover {
        background: #059669;
    }

    .auth-link {
        text-align: center;
        margin-top: 28px;
        padding-top: 28px;
        border-top: 1px solid #e5e7eb;
    }

    .auth-link a {
        color: #10b981;
        text-decoration: none;
        font-size: 14px;
    }

    .auth-link a:hover {
        text-decoration: underline;
    }

    .error-message {
        color: #ef4444;
        font-size: 13px;
        margin-top: 6px;
        display: block;
    }
</style>
@endpush
