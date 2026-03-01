<div>
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="app-name">نظام ميري للاستقدام</h1>
            <h2 class="auth-title">إنشاء حساب جديد</h2>
        </div>

        <form wire:submit="register" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label required">اسم المكتب</label>
                <input
                    type="text"
                    wire:model="name"
                    class="form-input"
                    required
                    maxlength="191"
                >
                @error('name') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label required">رقم السجل التجاري</label>
                <input
                    type="text"
                    wire:model="commercial_reg_no"
                    class="form-input"
                    required
                    maxlength="191"
                >
                @error('commercial_reg_no') <span class="error-message">{{ $message }}</span> @enderror
            </div>




            <div class="form-group">
                <label class="form-label">رقم الجوال</label>
                <input
                    type="tel"
                    wire:model="phone"
                    class="form-input"
                    maxlength="32"
                    placeholder="+966500000000"
                >
                @error('phone') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label required">البريد الإلكتروني</label>
                <input
                    type="email"
                    wire:model="email"
                    class="form-input"
                    required
                    maxlength="191"
                >
                @error('email') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">كلمة المرور</label>
                    <input
                        type="password"
                        wire:model="password"
                        class="form-input"
                        required
                        minlength="6"
                    >
                    @error('password') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required">تأكيد كلمة المرور</label>
                    <input
                        type="password"
                        wire:model="password_confirmation"
                        class="form-input"
                        required
                    >
                    @error('password_confirmation') <span class="error-message">{{ $message }}</span> @enderror
                </div>
            </div>


            <button type="submit" class="btn-submit">
                إنشاء حساب
            </button>
        </form>

        <div class="auth-link">
            <a href="{{ \App\Filament\Office\Pages\Auth\Login::getUrl() }}">
                لديك حساب بالفعل؟ تسجيل الدخول
            </a>
        </div>
    </div>
</div>

@push('styles')
<style>
    html, body {
        overflow-y: hidden;
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
        margin: 0 auto;
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
    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
        font-family: 'Cairo', sans-serif;
    }
    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: #054F31;
        box-shadow: 0 0 0 3px rgba(5, 79, 49, 0.1);
    }
    .form-textarea {
        resize: vertical;
        min-height: 80px;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }
    @media (max-width: 640px) {
        .form-row {
            grid-template-columns: 1fr;
        }
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
