<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'تسجيل الدخول') - مري للاستقدام</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Cairo', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f1f5f4; height: 100vh; overflow: hidden; display: flex; align-items: stretch; }

        /* ── Two-column shell ── */
        .auth-shell {
            display: flex;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        /* Left panel (white form side) */
        .auth-form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: #fff;
            height: 100vh;
            overflow-y: auto;
        }
        .auth-form-inner {
            width: 100%;
            max-width: 420px;
        }

        /* Right panel (dark green brand side) */
        .auth-brand-panel {
            width: 42%;
            flex-shrink: 0;
            background: linear-gradient(160deg, #054F31 0%, #0a6b42 60%, #043d26 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
            height: 100vh;
        }
        .auth-brand-panel::before {
            content: '';
            position: absolute;
            top: -60px; left: -60px;
            width: 220px; height: 220px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
        }
        .auth-brand-panel::after {
            content: '';
            position: absolute;
            bottom: -40px; right: -40px;
            width: 160px; height: 160px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
        }
        .brand-logo {
            width: 90px; height: 90px;
            border-radius: 50%;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.25rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .brand-logo img { width: 80px; height: 80px; object-fit: contain; }
        .brand-title { color: #fff; font-size: 1.5rem; font-weight: 900; text-align: center; margin-bottom: 0.4rem; }
        .brand-sub { color: rgba(255,255,255,0.65); font-size: 0.85rem; text-align: center; margin-bottom: 2rem; line-height: 1.6; }
        .brand-features { list-style: none; width: 100%; }
        .brand-features li {
            display: flex; align-items: center; gap: 0.6rem;
            color: rgba(255,255,255,0.85); font-size: 0.85rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .brand-features li:last-child { border-bottom: none; }
        .brand-features li span.icon {
            width: 28px; height: 28px; background: rgba(255,255,255,0.12);
            border-radius: 7px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .brand-features li span.icon svg { width: 15px; height: 15px; }

        /* Single-column pages (OTP, forget, reset) */
        .auth-shell.single-col {
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #054F31 0%, #0a7a4d 50%, #054F31 100%);
            overflow-y: auto;
            height: 100vh;
        }
        .auth-shell.single-col .auth-card-solo {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 24px 64px rgba(0,0,0,0.25);
            margin: auto;
        }
        .solo-logo {
            text-align: center;
            margin-bottom: 1.75rem;
        }
        .solo-logo-wrap {
            width: 72px; height: 72px; border-radius: 50%;
            background: #f0fdf4; border: 3px solid #a7f3d0;
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 0.875rem; overflow: hidden;
        }
        .solo-logo-wrap img { width: 58px; height: 58px; object-fit: contain; }
        .solo-title { font-size: 1.3rem; font-weight: 800; color: #111827; margin-bottom: 0.3rem; }
        .solo-sub { font-size: 0.85rem; color: #6b7280; }

        /* Form styles */
        .form-group { margin-bottom: 1rem; }
        .form-label { display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.375rem; }
        .form-input {
            width: 100%; border: 1.5px solid #e5e7eb; border-radius: 10px;
            padding: 0.7rem 2.5rem 0.7rem 0.875rem;
            font-family: 'Cairo', sans-serif; font-size: 0.9rem; color: #111827;
            outline: none; transition: border-color 0.2s; background: #fafafa;
        }
        .form-input:focus { border-color: #054F31; background: #fff; box-shadow: 0 0 0 3px rgba(5,79,49,0.08); }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%);
            color: #9ca3af; pointer-events: none;
        }
        .input-icon svg { width: 17px; height: 17px; }
        .form-error { color: #dc2626; font-size: 0.78rem; margin-top: 0.3rem; }

        .btn-primary {
            width: 100%; background: #054F31; color: #fff; border: none;
            border-radius: 10px; padding: 0.8rem; cursor: pointer;
            font-family: 'Cairo', sans-serif; font-size: 1rem; font-weight: 700;
            transition: background 0.15s; margin-top: 0.5rem; letter-spacing: 0.01em;
        }
        .btn-primary:hover { background: #043d26; }

        .auth-divider { text-align: center; margin: 1.1rem 0; font-size: 0.82rem; color: #9ca3af; }
        .auth-link-row { text-align: center; margin-top: 1rem; font-size: 0.875rem; color: #6b7280; }
        .auth-link-row a { color: #054F31; font-weight: 700; text-decoration: none; }

        .alert { padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.875rem; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .alert-warning { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }

        /* Page title above form */
        .form-page-title { font-size: 1.4rem; font-weight: 900; color: #111827; margin-bottom: 0.3rem; }
        .form-page-sub   { font-size: 0.85rem; color: #6b7280; margin-bottom: 1.75rem; }

        /* OTP boxes */
        .otp-boxes { display: flex; gap: 0.5rem; justify-content: center; direction: ltr; margin: 1.25rem 0; }
        .otp-box {
            width: 48px; height: 54px; border: 1.5px solid #e5e7eb; border-radius: 10px;
            font-size: 1.3rem; font-weight: 800; color: #111827; text-align: center;
            outline: none; background: #fafafa; transition: border-color 0.2s;
        }
        .otp-box:focus { border-color: #054F31; background: #fff; box-shadow: 0 0 0 3px rgba(5,79,49,0.08); }

        @media (max-width: 768px) {
            .auth-brand-panel { display: none; }
        }
    </style>
    @stack('auth-styles')
</head>
<body>
@yield('shell-content')
@stack('scripts')
</body>
</html>
