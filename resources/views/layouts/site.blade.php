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
        .footer-inner { display: grid; grid-template-columns: 2fr 1fr 1fr 1.4fr; gap: 2.5rem; margin-bottom: 2.5rem; }
        .footer-logo { display: flex; align-items: center; gap: .6rem; margin-bottom: .85rem; }
        .footer-logo img { height: 38px; width: auto; }
        .footer-logo-text { font-size: 1.05rem; font-weight: 800; color: var(--white); }
        .footer-desc { font-size: .87rem; color: rgba(255,255,255,.5); line-height: 1.85; margin-bottom: 1.25rem; }
        .footer-social { display: flex; gap: .5rem; }
        .social-btn { width: 34px; height: 34px; background: rgba(255,255,255,.08); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,.65); font-size: .85rem; text-decoration: none; transition: all .2s; }
        .social-btn:hover { background: var(--green-700); color: var(--white); }
        .footer-col h4 { color: var(--white); font-size: .95rem; font-weight: 700; margin-bottom: 1.1rem; }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: .55rem; }
        .footer-col a { color: rgba(255,255,255,.5); text-decoration: none; font-size: .87rem; transition: color .2s; }
        .footer-col a:hover { color: var(--green-400); }
        .footer-contact-item { display: flex; align-items: flex-start; gap: .6rem; margin-bottom: .65rem; color: rgba(255,255,255,.5); font-size: .87rem; }
        .footer-contact-item span:first-child { flex-shrink: 0; }
        .footer-divider { border: none; border-top: 1px solid rgba(255,255,255,.07); margin-bottom: 1.25rem; }
        .footer-bottom { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .75rem; }
        .footer-bottom p { font-size: .82rem; color: rgba(255,255,255,.3); }
        .footer-bottom a { color: rgba(255,255,255,.3); text-decoration: none; }
        .footer-bottom a:hover { color: var(--green-400); }

        /* ─── MOBILE BOTTOM NAV ─── */
        .mobile-bottom-nav {
            display: none;
            position: fixed; bottom: 0; left: 0; right: 0; z-index: 1000;
            background: var(--white);
            border-top: 1px solid var(--border);
            box-shadow: 0 -8px 32px rgba(0,0,0,.09);
            padding-bottom: env(safe-area-inset-bottom);
            align-items: stretch;
        }
        .mob-nav-item {
            flex: 1; display: flex; flex-direction: column; align-items: center;
            justify-content: center; padding: .55rem .1rem .5rem;
            text-decoration: none; color: var(--text-light);
            font-size: .58rem; font-weight: 700; font-family: 'Tajawal', sans-serif;
            gap: .18rem; transition: color .2s; min-height: 60px;
            position: relative;
        }
        .mob-nav-item svg { transition: transform .2s; }
        .mob-nav-item:hover svg, .mob-nav-item.active svg { transform: translateY(-1px); }
        .mob-nav-item:hover, .mob-nav-item.active { color: #15803d; }
        .mob-nav-item.active::after {
            content: ''; position: absolute; top: 0; left: 50%;
            transform: translateX(-50%);
            width: 24px; height: 3px; border-radius: 0 0 4px 4px;
            background: #15803d;
        }
        .mob-nav-label { white-space: nowrap; display: block; }
        /* centre CTA */
        .mob-nav-cta {
            flex: 1.2; display: flex; flex-direction: column; align-items: center;
            justify-content: flex-start; padding: 0 .1rem;
            text-decoration: none; font-family: 'Tajawal', sans-serif;
            gap: .18rem; min-height: 60px;
        }
        .mob-nav-cta-bubble {
            width: 48px; height: 48px; border-radius: 50%;
            background: linear-gradient(145deg, #15803d, #16a34a);
            box-shadow: 0 4px 16px rgba(21,128,61,.4);
            display: flex; align-items: center; justify-content: center;
            margin-top: -18px; transition: transform .2s, box-shadow .2s;
            flex-shrink: 0;
        }
        .mob-nav-cta:hover .mob-nav-cta-bubble { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(21,128,61,.5); }
        .mob-nav-cta-label {
            font-size: .56rem; font-weight: 800; color: #15803d;
            white-space: nowrap; display: block; margin-top: .05rem;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1024px) {
            .footer-inner { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            .nav-links, .nav-cta, .hamburger { display: none; }
            body { padding-bottom: calc(68px + env(safe-area-inset-bottom, 0px)); }
            .mobile-bottom-nav { display: flex; }
            footer { padding: 36px 0 calc(90px + env(safe-area-inset-bottom, 0px)); }
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
            .mob-nav-item { font-size: .52rem; padding: .48rem .05rem .42rem; min-height: 54px; }
            .mob-nav-cta-bubble { width: 42px; height: 42px; margin-top: -14px; }
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

    <!-- الرئيسية -->
    <a href="/" class="mob-nav-item {{ request()->is('/') ? 'active' : '' }}">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
            <polyline points="9 21 9 12 15 12 15 21"/>
        </svg>
        <span class="mob-nav-label">الرئيسية</span>
    </a>

    <!-- الخدمات -->
    <a href="/#features" class="mob-nav-item">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7" rx="1"/>
            <rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="3" y="14" width="7" height="7" rx="1"/>
            <rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>
        <span class="mob-nav-label">الخدمات</span>
    </a>

    <!-- انضم كمكتب — centre CTA -->
    <a href="/office/login" class="mob-nav-cta">
        <div class="mob-nav-cta-bubble">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
        </div>
        <span class="mob-nav-cta-label">انضم كمكتب</span>
    </a>

    <!-- تواصل معنا -->
    <a href="{{ route('contact') }}" class="mob-nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
        </svg>
        <span class="mob-nav-label">تواصل</span>
    </a>

    <!-- تنزيل -->
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
            <div>
                <div class="footer-logo">
                    <img src="/public/images/merry-logo.png" alt="نظام ميري">
                    <span class="footer-logo-text">نظام ميري</span>
                </div>
                <p class="footer-desc">منصة متكاملة تربط مكاتب الاستقدام والمستخدمين في منظومة واحدة لتقديم خدمات الاستقدام باحترافية وسهولة.</p>
                <div class="footer-social">
                    <a href="#" class="social-btn">𝕏</a>
                    <a href="#" class="social-btn">in</a>
                    <a href="#" class="social-btn">f</a>
                    <a href="#" class="social-btn">▶</a>
                </div>
            </div>
            <div class="footer-col">
                <h4>روابط سريعة</h4>
                <ul>
                    <li><a href="/">الرئيسية</a></li>
                    <li><a href="{{ route('about') }}">عن التطبيق</a></li>
                    <li><a href="/#features">الخدمات</a></li>
                    <li><a href="/#audience">للمكاتب</a></li>
                    <li><a href="/#how">كيف يعمل</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>القانوني</h4>
                <ul>
                    <li><a href="{{ route('privacy') }}">سياسة الخصوصية</a></li>
                    <li><a href="{{ route('terms') }}">الشروط والأحكام</a></li>
                    <li><a href="{{ route('security') }}">الأمان</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>تواصل معنا</h4>
                <div class="footer-contact-item"><span>📞</span><span dir="ltr">+966 57 938 1480</span></div>
                <div class="footer-contact-item"><span>✉️</span><span>info@mery.sa</span></div>
                <div class="footer-contact-item"><span>📍</span><span>الرياض - المملكة العربية السعودية</span></div>
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
