<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'نظام ميري - منصة متكاملة')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --green-900: #052e16;
            --green-800: #054F31;
            --green-700: #15803d;
            --green-600: #16a34a;
            --green-500: #22c55e;
            --green-400: #4ade80;
            --green-100: #dcfce7;
            --green-50:  #f0fdf4;
            --text-dark: #111827;
            --text-mid:  #374151;
            --text-light:#6b7280;
            --white:     #ffffff;
            --border:    #e5e7eb;
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
            --shadow-lg: 0 20px 60px rgba(5,79,49,.18);
            --nav-height: 68px;
            --page-header-padding-top: calc(var(--nav-height) + 32px);
            --page-header-padding-bottom: 52px;
            --page-section-padding: 64px;
            --page-section-padding-mobile: 44px;
            --footer-padding-top: 52px;
            --footer-padding-bottom: 24px;
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Tajawal', sans-serif; direction: rtl; background: var(--white); color: var(--text-dark); overflow-x: hidden; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }

        /* ─── NAVBAR ─── */
        nav {
            position: fixed; top: 0; width: 100%; z-index: 1000;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 2px 12px rgba(0,0,0,.06);
        }
        .nav-inner { display: flex; align-items: center; justify-content: space-between; height: var(--nav-height); }
        .nav-logo { display: flex; align-items: center; gap: .6rem; text-decoration: none; }
        .nav-logo img { height: 40px; width: auto; }
        .nav-logo-text { font-size: 1.1rem; font-weight: 800; color: var(--green-800); }
        .nav-links { display: flex; align-items: center; gap: .1rem; list-style: none; }
        .nav-links a {
            color: var(--text-mid); text-decoration: none; font-size: .88rem;
            font-weight: 600; padding: .45rem .8rem; border-radius: 8px; transition: all .2s;
        }
        .nav-links a:hover, .nav-links a.active { color: var(--green-700); background: var(--green-50); }
        .nav-cta { display: flex; align-items: center; gap: .6rem; }
        .nav-btn {
            padding: .48rem 1.2rem; border-radius: 50px; font-size: .87rem;
            font-weight: 700; cursor: pointer; text-decoration: none;
            font-family: 'Tajawal', sans-serif; transition: all .25s;
        }
        .nav-btn-outline { color: var(--green-800); border: 1.5px solid var(--green-700); background: transparent; }
        .nav-btn-outline:hover { background: var(--green-50); }
        .nav-btn-solid { background: var(--green-700); color: var(--white); border: 1.5px solid var(--green-700); }
        .nav-btn-solid:hover { background: var(--green-800); }
        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
        .hamburger span { display: block; width: 24px; height: 2px; background: var(--green-800); border-radius: 2px; }

        /* ─── PAGE HEADER ─── */
        .page-header {
            padding: var(--page-header-padding-top) 0 var(--page-header-padding-bottom);
            background: var(--green-50);
            text-align: center;
        }
        .page-header-tag {
            display: inline-block; background: var(--green-100); color: var(--green-800);
            padding: .3rem 1rem; border-radius: 50px; font-size: .82rem;
            font-weight: 700; margin-bottom: .75rem;
        }
        .page-header h1 { font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 900; color: var(--green-900); margin-bottom: .75rem; }
        .page-header p { font-size: 1rem; color: var(--text-mid); line-height: 1.8; max-width: 580px; margin: 0 auto; }

        /* ─── FOOTER ─── */
        footer { background: var(--green-900); padding: var(--footer-padding-top) 0 var(--footer-padding-bottom); }
        .footer-inner { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 2.5rem; margin-bottom: 2.5rem; }
        .footer-logo { display: flex; align-items: center; gap: .65rem; margin-bottom: .9rem; }
        .footer-logo img { height: 38px; width: auto; }
        .footer-logo-text { font-size: 1.05rem; font-weight: 800; color: var(--white); }
        .footer-desc { font-size: .87rem; color: rgba(255,255,255,.5); line-height: 1.85; margin-bottom: 1.25rem; }
        /* social */
        .footer-social { display: flex; gap: .45rem; }
        .social-btn {
            width: 36px; height: 36px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,.55); text-decoration: none;
            transition: background .2s, border-color .2s, color .2s;
        }
        .social-btn:hover { background: var(--green-700); border-color: var(--green-600); color: var(--white); }
        .social-btn svg { display: block; flex-shrink: 0; }
        /* columns */
        .footer-col h4 { color: var(--white); font-size: .93rem; font-weight: 700; margin-bottom: 1.1rem; letter-spacing: .01em; }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: .6rem; }
        .footer-col a { color: rgba(255,255,255,.48); text-decoration: none; font-size: .87rem; transition: color .2s; display: inline-flex; align-items: center; gap: .35rem; }
        .footer-col a::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: var(--green-700); flex-shrink: 0; transition: background .2s; }
        .footer-col a:hover { color: var(--green-400); }
        .footer-col a:hover::before { background: var(--green-400); }
        /* contact */
        .footer-contact-item { display: flex; align-items: flex-start; gap: .65rem; margin-bottom: .7rem; color: rgba(255,255,255,.48); font-size: .87rem; }
        .footer-contact-icon { width: 30px; height: 30px; background: rgba(255,255,255,.07); border-radius: 7px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .footer-contact-icon svg { display: block; }
        .footer-contact-text { line-height: 1.5; padding-top: .3rem; }
        /* divider & bottom */
        .footer-divider { border: none; border-top: 1px solid rgba(255,255,255,.07); margin-bottom: 1.25rem; }
        .footer-bottom { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .75rem; }
        .footer-bottom p { font-size: .82rem; color: rgba(255,255,255,.28); }
        .footer-bottom a { color: rgba(255,255,255,.28); text-decoration: none; transition: color .2s; }
        .footer-bottom a:hover { color: var(--green-400); }

        /* ─── MOBILE BOTTOM NAV ─── */
        .mobile-bottom-nav {
            display: none;
            position: fixed; bottom: 0; left: 0; right: 0; z-index: 1000;
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
            box-shadow: 0 -4px 20px rgba(0,0,0,.08);
            height: 62px;
            align-items: center;
            padding-bottom: env(safe-area-inset-bottom, 0px);
        }
        .mob-nav-item {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-decoration: none; color: #9ca3af;
            font-size: .58rem; font-weight: 700; font-family: 'Tajawal', sans-serif;
            gap: .22rem; height: 100%; position: relative; transition: color .2s;
        }
        .mob-nav-item:hover, .mob-nav-item.active { color: #15803d; }
        .mob-nav-item.active::before {
            content: ''; position: absolute; top: 0; left: 50%;
            transform: translateX(-50%);
            width: 28px; height: 3px; border-radius: 0 0 4px 4px;
            background: #15803d;
        }
        .mob-nav-item svg { display: block; flex-shrink: 0; }
        .mob-nav-label { white-space: nowrap; display: block; line-height: 1; }
        /* centre CTA */
        .mob-nav-cta {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-decoration: none; font-family: 'Tajawal', sans-serif;
            gap: .22rem; height: 100%;
        }
        .mob-nav-cta-box {
            width: 42px; height: 36px;
            background: linear-gradient(145deg, #15803d, #16a34a);
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 3px 12px rgba(21,128,61,.35);
            transition: transform .2s, box-shadow .2s; flex-shrink: 0;
        }
        .mob-nav-cta:hover .mob-nav-cta-box {
            transform: translateY(-2px); box-shadow: 0 6px 18px rgba(21,128,61,.45);
        }
        .mob-nav-cta-label {
            font-size: .55rem; font-weight: 800; color: #15803d;
            white-space: nowrap; display: block; line-height: 1;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1024px) {
            .footer-inner { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            .nav-links, .nav-cta, .hamburger { display: none; }
            body { padding-bottom: calc(62px + env(safe-area-inset-bottom, 0px)); }
            .mobile-bottom-nav { display: flex; }
            footer { padding: 36px 0 calc(80px + env(safe-area-inset-bottom, 0px)); }
            .footer-inner { grid-template-columns: 1fr; gap: 1.75rem; }
            .footer-bottom { flex-direction: column; text-align: center; gap: .5rem; }
            .page-header { padding: calc(var(--nav-height) + 20px) 0 40px; }
            .page-header h1 { font-size: clamp(1.5rem, 5vw, 2.4rem); }
        }
        @media (max-width: 480px) {
            .container { padding: 0 1rem; }
            .page-header { padding: calc(var(--nav-height) + 12px) 0 36px; }
            .page-header p { font-size: .92rem; }
        }
        @media (max-width: 360px) {
            .mob-nav-item { font-size: .52rem; gap: .16rem; }
            .mob-nav-item svg { width: 18px; height: 18px; }
            .mob-nav-cta-box { width: 36px; height: 32px; border-radius: 9px; }
            .mob-nav-cta-box svg { width: 18px; height: 18px; }
            .mob-nav-cta-label { font-size: .5rem; }
            .container { padding: 0 .75rem; }
            .page-header { padding: calc(var(--nav-height) + 10px) 0 32px; }
        }

    </style>
    @yield('styles')
</head>
<body>

<!-- NAVBAR -->
<nav id="navbar">
    <div class="container">
        <div class="nav-inner">
            <a href="/" class="nav-logo">
                <img src="/public/images/merry-logo.png" alt="نظام ميري">
                <span class="nav-logo-text">نظام ميري</span>
            </a>
            <ul class="nav-links">
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">الرئيسية</a></li>
                <li><a href="/#about">عن التطبيق</a></li>
                <li><a href="/#features">الخدمات</a></li>
                <li><a href="/#audience">لمن هو؟</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">تواصل معنا</a></li>
            </ul>
            <div class="nav-cta">
                <a href="/office/login" class="nav-btn nav-btn-outline">انضم كمكتب</a>
            </div>
        </div>
    </div>
</nav>

<!-- MOBILE BOTTOM NAV -->
<nav class="mobile-bottom-nav" aria-label="تنقل الجوال">

    <a href="/" class="mob-nav-item {{ request()->is('/') ? 'active' : '' }}">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
            <polyline points="9 21 9 12 15 12 15 21"/>
        </svg>
        <span class="mob-nav-label">الرئيسية</span>
    </a>

    <a href="/#features" class="mob-nav-item">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7" rx="1"/>
            <rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="3" y="14" width="7" height="7" rx="1"/>
            <rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>
        <span class="mob-nav-label">الخدمات</span>
    </a>

    <a href="/office/login" class="mob-nav-cta">
        <div class="mob-nav-cta-box">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
        </div>
        <span class="mob-nav-cta-label">انضم كمكتب</span>
    </a>

    <a href="{{ route('contact') }}" class="mob-nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
        </svg>
        <span class="mob-nav-label">تواصل</span>
    </a>

    <a href="{{ route('download') }}" class="mob-nav-item {{ request()->routeIs('download') ? 'active' : '' }}">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
            <polyline points="7 10 12 15 17 10"/>
            <line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
        <span class="mob-nav-label">تنزيل</span>
    </a>

</nav>

@yield('content')

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="footer-inner">

            {{-- ─── Brand column ─── --}}
            <div>
                <div class="footer-logo">
                    <img src="/public/images/merry-logo.png" alt="نظام ميري">
                    <span class="footer-logo-text">نظام ميري</span>
                </div>
                <p class="footer-desc">منصة متكاملة تربط مكاتب الاستقدام والمستخدمين في منظومة واحدة لتقديم خدمات الاستقدام باحترافية وسهولة.</p>
                <div class="footer-social">
                    {{-- X (Twitter) --}}
                    <a href="#" class="social-btn" aria-label="X">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.261 5.632 5.904-5.632Zm-1.161 17.52h1.833L7.084 4.126H5.117Z"/>
                        </svg>
                    </a>
                    {{-- LinkedIn --}}
                    <a href="#" class="social-btn" aria-label="LinkedIn">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    {{-- Instagram --}}
                    <a href="#" class="social-btn" aria-label="Instagram">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
                        </svg>
                    </a>
                    {{-- YouTube --}}
                    <a href="#" class="social-btn" aria-label="YouTube">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- ─── Quick links ─── --}}
            <div class="footer-col">
                <h4>روابط سريعة</h4>
                <ul>
                    <li><a href="/">الرئيسية</a></li>
                    <li><a href="{{ route('about') }}">عن التطبيق</a></li>
                    <li><a href="/#features">الخدمات</a></li>
                    <li><a href="/#audience">للمكاتب</a></li>
                    <li><a href="/#how">كيف يعمل</a></li>
                    <li><a href="{{ route('download') }}">تنزيل التطبيق</a></li>
                </ul>
            </div>

            {{-- ─── Legal ─── --}}
            <div class="footer-col">
                <h4>القانوني</h4>
                <ul>
                    <li><a href="{{ route('privacy') }}">سياسة الخصوصية</a></li>
                    <li><a href="{{ route('terms') }}">الشروط والأحكام</a></li>
                    <li><a href="{{ route('security') }}">الأمان</a></li>
                </ul>
            </div>

            {{-- ─── Contact ─── --}}
            <div class="footer-col">
                <h4>تواصل معنا</h4>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.55)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <span class="footer-contact-text" dir="ltr">+966 57 938 1480</span>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.55)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <span class="footer-contact-text">info@mery.sa</span>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.55)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <span class="footer-contact-text">الرياض، المملكة العربية السعودية</span>
                </div>
            </div>

        </div>
        <hr class="footer-divider">
        <div class="footer-bottom">
            <p>© جميع الحقوق محفوظة لنظام ميري 2026</p>
            <p>
                <a href="{{ route('privacy') }}">سياسة الخصوصية</a>
                &nbsp;·&nbsp;
                <a href="{{ route('terms') }}">الشروط والأحكام</a>
                &nbsp;·&nbsp;
                <a href="{{ route('security') }}">الأمان</a>
            </p>
        </div>
    </div>
</footer>

<script>
// Mobile bottom nav active state
document.querySelectorAll('.mob-nav-item').forEach(function(item) {
    if (item.getAttribute('href') && window.location.pathname === item.getAttribute('href').split('?')[0]) {
        item.classList.add('active');
    }
});
</script>
@yield('scripts')
</body>
</html>
