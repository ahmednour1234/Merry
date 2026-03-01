<div>
    <div class="auth-card">
        <h1 class="auth-title">تسجيل الدخول</h1>

        <form wire:submit="authenticate">
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
                <label class="form-label required">كلمة المرور</label>
                <div class="password-input-wrapper">
                    <input
                        type="{{ $showPassword ? 'text' : 'password' }}"
                        wire:model="password"
                        class="form-input"
                        required
                        autocomplete="current-password"
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

            <div class="form-options">
                <label class="remember-wrap" for="remember">
                    <input type="checkbox" wire:model="remember" id="remember">
                    <span>تذكرني</span>
                </label>
                <a href="#" class="forgot-password-link">نسيت كلمة المرور ؟</a>
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

@push('styles')
<style>
    .auth-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 40px;
        width: 100%;
        max-width: 600px;
        margin: 90px auto;
    }
    .auth-title {
        font-size: 24px;
        font-weight: 700;
        color: #054F31;
        text-align: center;
        margin-bottom: 30px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        margin-bottom: 8px;
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
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-direction: row-reverse;
        gap: 15px;
    }
    .remember-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #333;
        cursor: pointer;
    }
    .remember-wrap input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #054F31;
    }
    .forgot-password-link {
        color: #054F31;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
    }
    .forgot-password-link:hover {
        text-decoration: underline;
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
        margin-top: 10px;
    }
    .btn-submit:hover {
        background: #043a25;
    }
    .auth-link {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
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
