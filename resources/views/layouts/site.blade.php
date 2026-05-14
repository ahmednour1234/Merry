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
        .nav-inner { display: flex; align-items: center; justify-content: space-between; height: 68px; }
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
            padding: 100px 0 60px;
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
        footer { background: var(--green-900); padding: 60px 0 28px; }
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

        /* Mobile menu */
        .mobile-menu {
            display: none; position: fixed; inset: 0; z-index: 999;
            background: var(--white); padding: 80px 1.5rem 2rem;
            flex-direction: column; gap: 1rem; overflow-y: auto;
        }
        .mobile-menu.open { display: flex; }
        .mobile-menu a { color: var(--text-dark); text-decoration: none; font-size: 1.05rem; font-weight: 600; padding: .75rem 0; border-bottom: 1px solid var(--border); }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1024px) {
            .footer-inner { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            .nav-links, .nav-cta { display: none; }
            .hamburger { display: flex; }
            footer { padding: 40px 0 20px; }
            .footer-inner { grid-template-columns: 1fr; gap: 1.75rem; }
            .footer-bottom { flex-direction: column; text-align: center; gap: .5rem; }
        }
        @media (max-width: 480px) {
            .container { padding: 0 1rem; }
        }

        @yield('styles')
    </style>
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
                <li><a href="/">الرئيسية</a></li>
                <li><a href="/#about">عن التطبيق</a></li>
                <li><a href="/#features">الخدمات</a></li>
                <li><a href="/#audience">للمكاتب</a></li>
                <li><a href="/#audience">المستخدمين</a></li>
                <li><a href="/#how">كيف يعمل النظام</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">تواصل معنا</a></li>
            </ul>
            <div class="nav-cta">
                <a href="/office/login" class="nav-btn nav-btn-outline">دخول المكتب</a>
                <a href="/admin/login" class="nav-btn nav-btn-solid">لوحة التحكم</a>
            </div>
            <div class="hamburger" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
    <a href="/" onclick="toggleMenu()">الرئيسية</a>
    <a href="/#about" onclick="toggleMenu()">عن التطبيق</a>
    <a href="/#features" onclick="toggleMenu()">الخدمات</a>
    <a href="/#audience" onclick="toggleMenu()">للمكاتب</a>
    <a href="/#how" onclick="toggleMenu()">كيف يعمل النظام</a>
    <a href="{{ route('contact') }}" onclick="toggleMenu()">تواصل معنا</a>
    <a href="/office/login">دخول المكتب</a>
    <a href="/admin/login">لوحة التحكم</a>
</div>

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
                <div class="footer-contact-item"><span>📞</span><span>9200 00000</span></div>
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
function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('open');
}
document.addEventListener('click', function(e) {
    const menu = document.getElementById('mobileMenu');
    const hamburger = document.querySelector('.hamburger');
    if (menu.classList.contains('open') && !menu.contains(e.target) && !hamburger.contains(e.target)) {
        menu.classList.remove('open');
    }
});
</script>
@yield('scripts')
</body>
</html>
