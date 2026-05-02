<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نظام ميري - منصة متكاملة لإدارة خدمات الاستقدام</title>
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

        /* ─── HERO ─── */
        .hero {
            padding: 100px 0 60px;
            background: var(--green-50);
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute;
            width: 700px; height: 700px; border-radius: 50%;
            background: radial-gradient(circle, rgba(22,163,74,.1) 0%, transparent 70%);
            top: -200px; left: -200px; pointer-events: none;
        }
        .hero-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; position: relative; z-index: 1; }
        .hero-label {
            display: inline-flex; align-items: center; gap: .5rem;
            background: var(--white); color: var(--green-800);
            border: 1px solid var(--green-100);
            padding: .35rem 1rem; border-radius: 50px;
            font-size: .82rem; font-weight: 700; margin-bottom: 1.25rem;
        }
        .hero-label span { width: 7px; height: 7px; background: var(--green-500); border-radius: 50%; animation: pulse 2s infinite; }
        .hero-title { font-size: clamp(2rem, 4.5vw, 3.2rem); font-weight: 900; color: var(--green-900); line-height: 1.25; margin-bottom: 1.25rem; }
        .hero-title .hl { color: var(--green-600); }
        .hero-desc { font-size: 1rem; color: var(--text-mid); line-height: 1.9; margin-bottom: 2rem; }
        .hero-actions { display: flex; gap: .85rem; flex-wrap: wrap; margin-bottom: 2.5rem; }
        .btn-solid { background: var(--green-700); color: var(--white); padding: .7rem 1.8rem; border-radius: 50px; font-size: .95rem; font-weight: 700; font-family: 'Tajawal',sans-serif; text-decoration: none; border: none; cursor: pointer; transition: all .25s; display: inline-flex; align-items: center; gap: .4rem; }
        .btn-solid:hover { background: var(--green-800); transform: translateY(-2px); box-shadow: var(--shadow-lg); }
        .btn-ghost { background: transparent; color: var(--green-800); padding: .7rem 1.8rem; border-radius: 50px; font-size: .95rem; font-weight: 700; font-family: 'Tajawal',sans-serif; text-decoration: none; border: 1.5px solid var(--green-700); cursor: pointer; transition: all .25s; display: inline-flex; align-items: center; gap: .4rem; }
        .btn-ghost:hover { background: var(--green-50); transform: translateY(-2px); }
        .hero-stats { display: flex; gap: 0; border-top: 1px solid var(--border); padding-top: 1.75rem; background: var(--white); border-radius: var(--radius-lg); padding: 1.25rem; }
        .stat-item { flex: 1; text-align: center; padding: 0 .75rem; border-left: 1px solid var(--border); }
        .stat-item:last-child { border-left: none; }
        .stat-num { font-size: 1.6rem; font-weight: 900; color: var(--green-800); display: block; }
        .stat-label { font-size: .76rem; color: var(--text-light); margin-top: .1rem; display: block; }
        .hero-img-wrap img { width: 100%; display: block; }

        /* ─── SECTION COMMONS ─── */
        .section-head { text-align: center; margin-bottom: 3.5rem; }
        .section-tag {
            display: inline-block; background: var(--green-100); color: var(--green-800);
            padding: .3rem 1rem; border-radius: 50px; font-size: .82rem;
            font-weight: 700; margin-bottom: .75rem;
        }
        .section-title { font-size: clamp(1.7rem, 3.5vw, 2.4rem); font-weight: 800; color: var(--text-dark); margin-bottom: .75rem; line-height: 1.3; }
        .section-sub { font-size: .97rem; color: var(--text-light); line-height: 1.8; max-width: 580px; margin: 0 auto; }

        /* ─── ABOUT ─── */
        .about { padding: 90px 0; background: var(--white); }
        .about-desc { font-size: .97rem; color: var(--text-mid); line-height: 1.9; max-width: 680px; margin: 0 auto 3rem; text-align: center; }
        .about-cards { display: grid; grid-template-columns: repeat(4,1fr); gap: 1.25rem; }
        .about-card {
            background: var(--white); border: 1.5px solid var(--border);
            border-radius: var(--radius-lg); padding: 1.75rem 1.25rem;
            text-align: center; transition: all .3s;
        }
        .about-card:hover { border-color: var(--green-400); transform: translateY(-4px); box-shadow: var(--shadow-lg); }
        .about-icon { width: 56px; height: 56px; background: var(--green-50); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin: 0 auto 1rem; }
        .about-card h3 { font-size: 1rem; font-weight: 700; color: var(--text-dark); margin-bottom: .45rem; }
        .about-card p { font-size: .85rem; color: var(--text-light); line-height: 1.7; }

        /* ─── FEATURES ─── */
        .features { padding: 90px 0; background: var(--green-50); }
        .features-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.25rem; }
        .feat-card {
            background: var(--white); border-radius: var(--radius-lg);
            padding: 1.75rem; border: 1.5px solid var(--border); transition: all .3s;
        }
        .feat-card:hover { border-color: var(--green-500); transform: translateY(-4px); box-shadow: var(--shadow-lg); }
        .feat-icon { width: 52px; height: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1rem; }
        .feat-card h3 { font-size: 1rem; font-weight: 700; color: var(--text-dark); margin-bottom: .4rem; }
        .feat-card p { font-size: .87rem; color: var(--text-light); line-height: 1.75; }

        /* ─── HOW ─── */
        .how { padding: 90px 0; background: var(--white); }
        .how-steps { display: flex; gap: 0; position: relative; margin-top: 3rem; }
        .how-steps::before { content: ''; position: absolute; top: 36px; right: 8%; left: 8%; height: 2px; background: linear-gradient(to left, var(--green-100), var(--green-500), var(--green-100)); z-index: 0; }
        .how-step { flex: 1; text-align: center; padding: 0 .75rem; position: relative; z-index: 1; }
        .step-num {
            width: 72px; height: 72px; border-radius: 50%;
            background: var(--green-800); color: var(--white);
            font-size: 1.15rem; font-weight: 900;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
            border: 4px solid var(--white); box-shadow: 0 0 0 2px var(--green-600);
            transition: all .3s;
        }
        .how-step:hover .step-num { background: var(--green-600); transform: scale(1.08); }
        .step-title { font-size: .95rem; font-weight: 700; color: var(--text-dark); margin-bottom: .4rem; }
        .step-desc { font-size: .82rem; color: var(--text-light); line-height: 1.7; }

        /* ─── AUDIENCE ─── */
        .audience { background: var(--white); }
        .audience-inner { display: flex; width: 100%; }
        .aud-panel {
            flex: 1; padding: 4rem 3.5rem 0; position: relative;
            display: flex; flex-direction: column;
        }
        .aud-panel-offices {
            background: var(--green-800);
            background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 28px 28px;
            order: 2; /* offices on RIGHT in RTL flex */
        }
        .aud-panel-users {
            background: var(--white);
            border: 1px solid var(--border);
            order: 1; /* users on LEFT in RTL flex */
        }
        .aud-content { flex: 1; }
        .aud-tag {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .3rem .9rem; border-radius: 50px; font-size: .82rem; font-weight: 700;
            margin-bottom: 1.25rem;
        }
        .aud-tag-offices { background: rgba(255,255,255,.15); color: rgba(255,255,255,.95); }
        .aud-tag-users { background: var(--green-100); color: var(--green-800); }
        .aud-title { font-size: 1.75rem; font-weight: 800; margin-bottom: 1.25rem; }
        .aud-title-offices { color: var(--white); }
        .aud-title-users { color: var(--text-dark); }
        .aud-list { list-style: none; display: flex; flex-direction: column; gap: .85rem; margin-bottom: 2rem; }
        .aud-list li { display: flex; align-items: flex-start; gap: .7rem; font-size: .9rem; line-height: 1.65; }
        .aud-list-offices li { color: rgba(255,255,255,.78); }
        .aud-list-users li { color: var(--text-mid); }
        .aud-check {
            width: 22px; height: 22px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .65rem; flex-shrink: 0; margin-top: .15rem; font-weight: 700;
        }
        .aud-check-offices { background: var(--green-500); color: var(--white); }
        .aud-check-users { background: var(--green-100); color: var(--green-700); }
        .aud-img-wrap { margin-top: 2.5rem; line-height: 0; }
        .aud-img { width: 100%; display: block; }

        /* ─── CTA ─── */
        .cta { padding: 80px 0; background: linear-gradient(135deg, var(--green-800), var(--green-700)); position: relative; overflow: hidden; }
        .cta::before { content: ''; position: absolute; width: 400px; height: 400px; background: rgba(255,255,255,.04); border-radius: 50%; top: -150px; left: -100px; }
        .cta::after  { content: ''; position: absolute; width: 300px; height: 300px; background: rgba(255,255,255,.04); border-radius: 50%; bottom: -100px; right: -80px; }
        .cta-inner { text-align: center; position: relative; z-index: 1; }
        .cta-icon { font-size: 3rem; margin-bottom: 1rem; }
        .cta-title { font-size: clamp(1.8rem, 3.5vw, 2.6rem); font-weight: 900; color: var(--white); margin-bottom: .75rem; }
        .cta-sub { font-size: 1rem; color: rgba(255,255,255,.8); line-height: 1.85; margin-bottom: 2rem; }
        .cta-actions { display: flex; justify-content: center; gap: .85rem; flex-wrap: wrap; }
        .cta-btn-white { background: var(--white); color: var(--green-800); padding: .75rem 2rem; border-radius: 50px; font-size: .95rem; font-weight: 700; font-family: 'Tajawal',sans-serif; text-decoration: none; border: none; cursor: pointer; transition: all .25s; display: inline-flex; align-items: center; gap: .4rem; }
        .cta-btn-white:hover { background: var(--green-100); transform: translateY(-2px); }
        .cta-btn-outline { background: transparent; color: var(--white); padding: .75rem 2rem; border-radius: 50px; font-size: .95rem; font-weight: 700; font-family: 'Tajawal',sans-serif; text-decoration: none; border: 1.5px solid rgba(255,255,255,.5); cursor: pointer; transition: all .25s; display: inline-flex; align-items: center; gap: .4rem; }
        .cta-btn-outline:hover { background: rgba(255,255,255,.1); transform: translateY(-2px); }
        .cta-note { margin-top: 1rem; font-size: .82rem; color: rgba(255,255,255,.4); }

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

        /* Animations */
        @keyframes pulse { 0%,100%{transform:scale(1);opacity:1} 50%{transform:scale(1.5);opacity:.6} }
        @keyframes fadeUp { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }
        .fade-up { animation: fadeUp .65s ease forwards; }
        .d1 { animation-delay: .12s; opacity:0; }
        .d2 { animation-delay: .24s; opacity:0; }
        .d3 { animation-delay: .36s; opacity:0; }
        .d4 { animation-delay: .48s; opacity:0; }

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
            .features-grid { grid-template-columns: repeat(2,1fr); }
            .about-cards { grid-template-columns: repeat(2,1fr); }
            .footer-inner { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            .nav-links, .nav-cta { display: none; }
            .hamburger { display: flex; }
            .hero-inner { grid-template-columns: 1fr; text-align: center; }
            .hero-img-wrap { order: -1; }
            .hero-actions { justify-content: center; }
            .hero-stats { flex-wrap: wrap; }
            .stat-item { flex: 1 1 40%; }
            .features-grid { grid-template-columns: 1fr; }
            .about-cards { grid-template-columns: 1fr 1fr; }
            .how-steps { flex-direction: column; gap: 1.5rem; }
            .how-steps::before { display: none; }
            .audience-inner { grid-template-columns: 1fr; }
            .aud-panel { padding: 3rem 1.5rem; }
            .footer-inner { grid-template-columns: 1fr; gap: 2rem; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav id="navbar">
    <div class="container">
        <div class="nav-inner">
            <a href="#" class="nav-logo">
                <img src="/public/images/merry-logo.png" alt="نظام ميري">
                <span class="nav-logo-text">نظام ميري</span>
            </a>
            <ul class="nav-links">
                <li><a href="#" class="active">الرئيسية</a></li>
                <li><a href="#about">عن التطبيق</a></li>
                <li><a href="#features">الخدمات</a></li>
                <li><a href="#audience">للمكاتب</a></li>
                <li><a href="#audience">المستخدمين</a></li>
                <li><a href="#how">كيف يعمل النظام</a></li>
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
    <a href="#" onclick="toggleMenu()">الرئيسية</a>
    <a href="#about" onclick="toggleMenu()">عن التطبيق</a>
    <a href="#features" onclick="toggleMenu()">الخدمات</a>
    <a href="#audience" onclick="toggleMenu()">للمكاتب</a>
    <a href="#how" onclick="toggleMenu()">كيف يعمل النظام</a>
    <a href="/office/login">دخول المكتب</a>
    <a href="/admin/login">لوحة التحكم</a>
</div>

<!-- HERO -->
<section class="hero" id="home">
    <div class="container">
        <div class="hero-inner">
            <div>
                <div class="hero-label fade-up">
                    <span></span>
                    منصة موثوقة لأكثر من 500 مكتب
                </div>
                <h1 class="hero-title fade-up d1">
                    منصة متكاملة لإدارة<br>
                    <span class="hl">خدمات الاستقدام</span>
                </h1>
                <p class="hero-desc fade-up d2">
                    نظام ميري يساعد مكاتب الاستقدام والمستخدمين في منظومة واحدة تضم
                    جميع خدمات ومتابعة الحالات وتنظيم البيانات والاطلاع على التقارير
                    بسهولة وكفاءة عالية.
                </p>
                <div class="hero-actions fade-up d3">
                    <a href="#" class="btn-solid">🚀 ابدأ مجاناً</a>
                    <a href="#about" class="btn-ghost">تعرف على المزيد</a>
                </div>
                <div class="hero-stats fade-up d4">
                    <div class="stat-item">
                        <span class="stat-num">+500</span>
                        <span class="stat-label">مكتب استقدام</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-num">+10K</span>
                        <span class="stat-label">سيرة ذاتية</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-num">99%</span>
                        <span class="stat-label">رضا العملاء</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-num">24/7</span>
                        <span class="stat-label">دعم فني</span>
                    </div>
                </div>
            </div>
            <div class="hero-img-wrap">
                <img src="/public/images/multi-device.png" alt="نظام ميري على جميع الأجهزة">
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="about" id="about">
    <div class="container">
        <div class="section-head">
            <div class="section-tag">✨ عن التطبيق</div>
            <h2 class="section-title">نظام شامل لكل ما تحتاجه</h2>
            <p class="about-desc">
                نظام ميري هو منصة تقنية متطورة تربط مكاتب الاستقدام والمستخدمين في منظومة واحدة
                لتقديم خدمات الاستقدام من تقديم الطلب حتى إتمام الخدمة بكل سهولة واحترافية
                في منصة واحدة متكاملة وآمنة.
            </p>
        </div>
        <div class="about-cards">
            <div class="about-card">
                <div class="about-icon">📋</div>
                <h3>إدارة الطلبات</h3>
                <p>متابعة كل طلبات الاستقدام من البداية إلى الإتمام النهائي</p>
            </div>
            <div class="about-card">
                <div class="about-icon">🔔</div>
                <h3>متابعة الحالات</h3>
                <p>إشعارات فورية وتتبع لحظي لكل مرحلة من مراحل الطلب</p>
            </div>
            <div class="about-card">
                <div class="about-icon">🗄️</div>
                <h3>إدارة البيانات</h3>
                <p>قاعدة بيانات موحدة لكل المعاملات والوثائق والسجلات</p>
            </div>
            <div class="about-card">
                <div class="about-icon">📊</div>
                <h3>التقارير والإشعارات</h3>
                <p>تقارير تفصيلية وإشعارات ذكية تبقيك على اطلاع دائم</p>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="features" id="features">
    <div class="container">
        <div class="section-head">
            <div class="section-tag">⚡ مميزات نظام ميري</div>
            <h2 class="section-title">كل ما تحتاجه في مكان واحد</h2>
            <p class="section-sub">نوفر لك أدوات متطورة تجعل إدارة أعمال الاستقدام أسرع وأكثر دقة وكفاءة</p>
        </div>
        <div class="features-grid">
            <div class="feat-card">
                <div class="feat-icon" style="background:#dcfce7">👥</div>
                <h3>إدارة المستخدمين والصلاحيات</h3>
                <p>تحكم كامل في الأدوار والصلاحيات لكل فرد في فريقك بمرونة عالية</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon" style="background:#dbeafe">📊</div>
                <h3>لوحة تحكم متكاملة</h3>
                <p>إحصاءات ومؤشرات أداء فورية تساعدك على اتخاذ قرارات صحيحة</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon" style="background:#fef3c7">⚡</div>
                <h3>إدارة سير العمل</h3>
                <p>أتمتة ذكية لعمليات الاستقدام تقلل الأخطاء وتوفر الوقت والجهد</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon" style="background:#fce7f3">🔔</div>
                <h3>إشعارات وتنبيهات ذكية</h3>
                <p>ابق على اطلاع دائم بكل المستجدات والتحديثات في الوقت الفعلي</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon" style="background:#f0fdf4">📈</div>
                <h3>تقارير وإحصائيات مفصلة</h3>
                <p>تحليلات متعمقة وتقارير شاملة لكل جوانب عملك وأدائك</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon" style="background:#ede9fe">🛡️</div>
                <h3>دعم فني متوفر</h3>
                <p>فريق دعم متخصص على مدار الساعة لمساعدتك في أي وقت تحتاجه</p>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="how" id="how">
    <div class="container">
        <div class="section-head">
            <div class="section-tag">🔄 كيف يعمل النظام؟</div>
            <h2 class="section-title">خطوات بسيطة للبداية</h2>
            <p class="section-sub" style="margin:0 auto">خمس خطوات سهلة تبدأ بها رحلتك مع نظام ميري</p>
        </div>
        <div class="how-steps">
            <div class="how-step">
                <div class="step-num">05</div>
                <div class="step-title">التقارير والتوصيات</div>
                <div class="step-desc">استلام التقرير النهائي وتقييم الخدمة</div>
            </div>
            <div class="how-step">
                <div class="step-num">04</div>
                <div class="step-title">إتمام الخدمة</div>
                <div class="step-desc">إتمام جميع الإجراءات واستكمال المعاملات</div>
            </div>
            <div class="how-step">
                <div class="step-num">03</div>
                <div class="step-title">متابعة الحالة</div>
                <div class="step-desc">تتبع لحظي لكل مرحلة من مراحل المعالجة</div>
            </div>
            <div class="how-step">
                <div class="step-num">02</div>
                <div class="step-title">دراسة الطلب</div>
                <div class="step-desc">يراجع المكتب الطلب ويقيّم الاحتياجات</div>
            </div>
            <div class="how-step">
                <div class="step-num">01</div>
                <div class="step-title">تقديم الطلب</div>
                <div class="step-desc">يقدم المستخدم طلبه بكل سهولة عبر المنصة</div>
            </div>
        </div>
    </div>
</section>

<!-- AUDIENCE -->
<section class="audience" id="audience">
    <div class="audience-inner">
        <!-- للمكاتب — dark green -->
        <div class="aud-panel aud-panel-offices">
            <div class="aud-tag aud-tag-offices">🏢 للمكاتب</div>
            <h2 class="aud-title aud-title-offices">حل متكامل لمكتبك</h2>
            <ul class="aud-list aud-list-offices">
                <li><div class="aud-check aud-check-offices">✓</div>لوحة تحكم متكاملة لإدارة جميع طلبات الاستقدام ومتابعتها لحظة بلحظة</li>
                <li><div class="aud-check aud-check-offices">✓</div>أدوات متطورة لرفع السير الذاتية وإدارة قاعدة بيانات العمالة</li>
                <li><div class="aud-check aud-check-offices">✓</div>تقارير مالية وإحصائية شاملة لمتابعة أداء المكتب ونموه</li>
                <li><div class="aud-check aud-check-offices">✓</div>إشعارات فورية للطلبات الجديدة وتحديثات حالة كل معاملة</li>
                <li><div class="aud-check aud-check-offices">✓</div>إدارة العروض الترويجية والكوبونات وخطط الاشتراكات</li>
            </ul>
            <a href="/office/login" class="btn-solid">ابدأ مع مكتبك</a>
            <img src="/public/images/dashboard-mockup.png" alt="لوحة تحكم المكتب" class="aud-img">
        </div>
        <!-- للمستخدمين — white -->
        <div class="aud-panel aud-panel-users">
            <div class="aud-tag aud-tag-users">👤 للمستخدمين</div>
            <h2 class="aud-title aud-title-users">تجربة سلسة للمستخدم</h2>
            <ul class="aud-list aud-list-users">
                <li><div class="aud-check aud-check-users">✓</div>تقديم طلبات الاستقدام بشكل سهل وسريع من أي مكان وأي وقت</li>
                <li><div class="aud-check aud-check-users">✓</div>تصفح السير الذاتية واختيار أفضل المرشحين المناسبين</li>
                <li><div class="aud-check aud-check-users">✓</div>متابعة حالة طلبك لحظة بلحظة مع إشعارات فورية</li>
                <li><div class="aud-check aud-check-users">✓</div>تواصل مباشر مع المكتب واستلام الوثائق إلكترونياً</li>
                <li><div class="aud-check aud-check-users">✓</div>سجل كامل بجميع معاملاتك السابقة وتقييمات مضمونة</li>
            </ul>
            <a href="#" class="btn-ghost">ابدأ كمستخدم</a>
            <img src="/public/images/hero-users.png" alt="مستخدمو نظام ميري" class="aud-img">
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta" id="contact">
    <div class="container">
        <div class="cta-inner">
            <div class="cta-icon">🛡️</div>
            <h2 class="cta-title">نظام متكامل.. لإدارة أفضل</h2>
            <p class="cta-sub">
                انضم إلى أكثر من 500 مكتب استقدام يستخدمون نظام ميري يومياً<br>
                وابدأ رحلتك نحو عمل أكثر احترافية وكفاءة
            </p>
            <div class="cta-actions">
                <a href="#" class="cta-btn-white">🚀 ابدأ مجاناً الآن</a>
                <a href="tel:+966000000000" class="cta-btn-outline">📞 تواصل معنا</a>
            </div>
            <p class="cta-note">لا يلزم بطاقة ائتمانية · تجربة مجانية 14 يوم</p>
        </div>
    </div>
</section>

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
                    <li><a href="#">الرئيسية</a></li>
                    <li><a href="#about">عن التطبيق</a></li>
                    <li><a href="#features">الخدمات</a></li>
                    <li><a href="#audience">للمكاتب</a></li>
                    <li><a href="#how">كيف يعمل</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>خدماتنا</h4>
                <ul>
                    <li><a href="#">إدارة الطلبات</a></li>
                    <li><a href="#">إدارة المكاتب</a></li>
                    <li><a href="#">السير الذاتية</a></li>
                    <li><a href="#">التقارير</a></li>
                    <li><a href="#">الدعم الفني</a></li>
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
                <a href="#" style="color:rgba(255,255,255,.3);text-decoration:none">سياسة الخصوصية</a>
                &nbsp;·&nbsp;
                <a href="#" style="color:rgba(255,255,255,.3);text-decoration:none">الشروط والأحكام</a>
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
</body>
</html>
