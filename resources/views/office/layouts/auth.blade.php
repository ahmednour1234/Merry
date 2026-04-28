<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'تسجيل الدخول') - مكتب النخبة</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Cairo', sans-serif; }
        body { background: linear-gradient(135deg, #054F31 0%, #0a7a4d 50%, #054F31 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1rem; }

        .auth-card {
            background: #fff;
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-logo-icon {
            width: 64px; height: 64px;
            background: #054F31;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
        }

        .auth-logo-icon svg { width: 32px; height: 32px; }
        .auth-logo h1 { font-size: 1.4rem; font-weight: 800; color: #054F31; margin: 0; }
        .auth-logo p  { font-size: 0.85rem; color: #6b7280; margin: 0.25rem 0 0; }

        .form-input {
            width: 100%; border: 1px solid #d1d5db; border-radius: 8px;
            padding: 0.65rem 0.875rem; font-family: 'Cairo', sans-serif;
            font-size: 0.9rem; color: #111827; outline: none;
            transition: border-color 0.2s; box-sizing: border-box;
        }
        .form-input:focus { border-color: #054F31; box-shadow: 0 0 0 3px rgba(5,79,49,0.1); }
        .form-label { display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.375rem; }
        .form-error { color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem; }

        .btn-primary {
            width: 100%; background: #054F31; color: #fff; border: none;
            border-radius: 8px; padding: 0.75rem; cursor: pointer;
            font-family: 'Cairo', sans-serif; font-size: 1rem; font-weight: 700;
            transition: background 0.2s; margin-top: 0.5rem;
        }
        .btn-primary:hover { background: #043d26; }

        .auth-links { text-align: center; margin-top: 1.25rem; font-size: 0.875rem; color: #6b7280; }
        .auth-links a { color: #054F31; font-weight: 600; text-decoration: none; }
        .auth-links a:hover { text-decoration: underline; }

        .alert { padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.875rem; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .alert-warning { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-logo">
            <div class="auth-logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>
            </div>
            <h1>مكتب النخبة للاستقدام</h1>
            <p>@yield('auth-subtitle', 'مرحباً بك في لوحة التحكم')</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
