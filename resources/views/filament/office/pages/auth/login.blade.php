<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - تطبيق ميري</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @filamentStyles
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 40px;
            width: 100%;
            max-width: 450px;
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
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        .form-input:focus {
            outline: none;
            border-color: #054F31;
            box-shadow: 0 0 0 3px rgba(5, 79, 49, 0.1);
        }
        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
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
</head>
<body>
    <div class="auth-card">
        <h1 class="auth-title">تسجيل الدخول</h1>

        <form wire:submit="authenticate">
            <div class="form-group">
                <label class="form-label">البريد الإلكتروني</label>
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
                <label class="form-label">كلمة المرور</label>
                <input
                    type="password"
                    wire:model="password"
                    class="form-input"
                    required
                >
                @error('password') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-checkbox">
                <input
                    type="checkbox"
                    wire:model="remember"
                    id="remember"
                >
                <label for="remember">تذكرني</label>
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

    @filamentScripts
</body>
</html>
