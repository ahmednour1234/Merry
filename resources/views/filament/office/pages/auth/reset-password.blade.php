<div>
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="app-name">نظام ميري للاستقدام</h1>
            <h2 class="auth-title">إعادة تعيين كلمة المرور</h2>
        </div>

        <form wire:submit="reset">
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

            <div class="form-group">
                <label class="form-label required">رمز التحقق</label>
                <input
                    type="text"
                    wire:model="code"
                    class="form-input"
                    required
                    maxlength="6"
                    placeholder="000000"
                >
                @error('code') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label required">كلمة المرور الجديدة</label>
                <div class="password-input-wrapper">
                    <input
                        type="{{ $showPassword ? 'text' : 'password' }}"
                        wire:model="password"
                        class="form-input"
                        required
                        minlength="6"
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

            <div class="form-group">
                <label class="form-label required">تأكيد كلمة المرور</label>
                <input
                    type="{{ $showPassword ? 'text' : 'password' }}"
                    wire:model="password_confirmation"
                    class="form-input"
                    required
                >
                @error('password_confirmation') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-submit">
                إعادة تعيين كلمة المرور
            </button>
        </form>

        <div class="auth-link">
            <a href="{{ \App\Filament\Office\Pages\Auth\Login::getUrl() }}">
                تذكرت كلمة المرور؟ تسجيل الدخول
            </a>
        </div>
    </div>
</div>

@push('styles')
<style>
    html, body {
        height: 100%;
        direction: rtl;
    }
    .auth-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 40px;
        width: 100%;
        max-width: 600px;
        margin: 85px auto;
    }
    .auth-header {
        text-align: center;
        margin-bottom: 25px;
    }
    .app-name {
        font-size: 28px;
        font-weight: 800;
        color: #054F31;
        margin: 0 0 8px 0;
    }
    .auth-title {
        font-size: 20px;
        font-weight: 600;
        color: #666;
        text-align: center;
        margin: 0 0 20px 0;
    }
    .form-group {
        margin-bottom: 12px;
    }
    .form-label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }
    .form-label.required::after {
        content: ' *';
        color: #ef4444;
    }
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
        font-family: 'Cairo', sans-serif;
    }
    .form-input:focus {
        outline: none;
        border-color: #054F31;
        box-shadow: 0 0 0 3px rgba(5, 79, 49, 0.1);
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
        padding-left: 16px;
    }
    .btn-submit {
        width: 100%;
        padding: 14px;
        background: #054F31;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 8px;
    }
    .btn-submit:hover {
        background: #043a25;
    }
    .auth-link {
        text-align: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }
    .auth-link a {
        color: #054F31;
        text-decoration: none;
        font-size: 14px;
    }
    .auth-link a:hover {
        text-decoration: underline;
    }
    .error-message {
        color: #ef4444;
        font-size: 14px;
        margin-top: 5px;
    }
</style>
@endpush
