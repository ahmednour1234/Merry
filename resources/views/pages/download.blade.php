@extends('layouts.site')

@section('title', 'تنزيل تطبيق ميري')

@section('styles')
<style>
    /* ─── DOWNLOAD PAGE ─── */
    .dl-hero {
        padding: 100px 0 70px;
        background: linear-gradient(135deg, var(--green-900) 0%, var(--green-700) 100%);
        text-align: center; position: relative; overflow: hidden;
    }
    .dl-hero::before {
        content: ''; position: absolute;
        width: 600px; height: 600px; border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,.05) 0%, transparent 70%);
        top: -200px; right: -100px; pointer-events: none;
    }
    .dl-hero-tag {
        display: inline-flex; align-items: center; gap: .5rem;
        background: rgba(255,255,255,.12); color: var(--white);
        border: 1px solid rgba(255,255,255,.2);
        padding: .35rem 1.1rem; border-radius: 50px;
        font-size: .82rem; font-weight: 700; margin-bottom: 1.5rem;
    }
    .dl-hero h1 { font-size: clamp(2rem, 5vw, 3.2rem); font-weight: 900; color: var(--white); margin-bottom: 1rem; line-height: 1.25; }
    .dl-hero p { font-size: 1.05rem; color: rgba(255,255,255,.8); line-height: 1.9; max-width: 560px; margin: 0 auto 2.5rem; }
    .dl-badges { display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap; }
    .dl-badge {
        display: inline-flex; align-items: center; gap: .7rem;
        background: var(--white); color: var(--text-dark);
        padding: .7rem 1.6rem; border-radius: 14px;
        text-decoration: none; font-weight: 700; font-size: .95rem;
        font-family: 'Tajawal', sans-serif;
        transition: all .25s; box-shadow: 0 4px 20px rgba(0,0,0,.15);
    }
    .dl-badge:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(0,0,0,.2); }
    .dl-badge-icon { font-size: 1.6rem; }
    .dl-badge-text { display: flex; flex-direction: column; text-align: right; }
    .dl-badge-sub { font-size: .7rem; font-weight: 400; color: var(--text-light); }
    .dl-badge-main { font-size: 1rem; font-weight: 800; color: var(--text-dark); }
    .dl-badge.dark { background: #1c1c1e; color: var(--white); }
    .dl-badge.dark .dl-badge-main { color: var(--white); }
    .dl-badge.dark .dl-badge-sub { color: rgba(255,255,255,.6); }

    /* Phone mockup */
    .dl-mockup-section { padding: 80px 0; background: var(--green-50); }
    .dl-mockup-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
    .dl-phone {
        width: 260px; margin: 0 auto;
        background: var(--green-900); border-radius: 40px;
        padding: 12px; box-shadow: 0 40px 80px rgba(5,46,22,.35);
        position: relative;
    }
    .dl-phone-notch {
        width: 100px; height: 26px; background: var(--green-900);
        border-radius: 0 0 18px 18px; margin: 0 auto 4px;
        position: relative; z-index: 2;
    }
    .dl-phone-screen {
        background: var(--white); border-radius: 30px;
        overflow: hidden; aspect-ratio: 9/19;
        display: flex; flex-direction: column;
    }
    .phone-header {
        background: var(--green-800); padding: 1rem 1rem .75rem;
        display: flex; align-items: center; gap: .5rem;
    }
    .phone-header-logo { width: 28px; height: 28px; background: var(--white); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: .8rem; font-weight: 900; color: var(--green-800); }
    .phone-header-title { color: var(--white); font-size: .8rem; font-weight: 800; }
    .phone-body { padding: .75rem; display: flex; flex-direction: column; gap: .5rem; flex: 1; }
    .phone-card {
        background: var(--green-50); border-radius: 10px; padding: .6rem .75rem;
        display: flex; align-items: center; gap: .5rem;
    }
    .phone-card-icon { font-size: 1.1rem; }
    .phone-card-text { font-size: .65rem; color: var(--text-mid); font-weight: 700; }
    .phone-stat-row { display: grid; grid-template-columns: 1fr 1fr; gap: .5rem; margin-top: .25rem; }
    .phone-stat { background: var(--white); border: 1px solid var(--border); border-radius: 10px; padding: .6rem; text-align: center; }
    .phone-stat-num { font-size: .9rem; font-weight: 900; color: var(--green-800); display: block; }
    .phone-stat-lbl { font-size: .55rem; color: var(--text-light); display: block; }
    .phone-btn { background: var(--green-700); color: var(--white); text-align: center; padding: .55rem; border-radius: 10px; font-size: .7rem; font-weight: 800; margin-top: .25rem; }

    .dl-features { }
    .dl-features h2 { font-size: 1.7rem; font-weight: 900; color: var(--text-dark); margin-bottom: .6rem; }
    .dl-features > p { font-size: .97rem; color: var(--text-mid); line-height: 1.85; margin-bottom: 2rem; }
    .dl-feat-list { display: flex; flex-direction: column; gap: 1rem; }
    .dl-feat-item { display: flex; align-items: flex-start; gap: 1rem; }
    .dl-feat-badge {
        width: 44px; height: 44px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; flex-shrink: 0;
    }
    .dl-feat-item h3 { font-size: .95rem; font-weight: 800; color: var(--text-dark); margin-bottom: .2rem; }
    .dl-feat-item p { font-size: .85rem; color: var(--text-light); line-height: 1.65; }

    /* Stats */
    .dl-stats { padding: 70px 0; background: var(--white); }
    .dl-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    .dl-stat-card {
        background: var(--green-50); border: 1.5px solid var(--green-100);
        border-radius: var(--radius-lg); padding: 2rem 1.25rem; text-align: center;
        transition: all .3s;
    }
    .dl-stat-card:hover { border-color: var(--green-400); transform: translateY(-4px); box-shadow: var(--shadow-lg); }
    .dl-stat-card .num { font-size: 2.2rem; font-weight: 900; color: var(--green-800); display: block; }
    .dl-stat-card .lbl { font-size: .85rem; color: var(--text-light); margin-top: .3rem; display: block; }

    /* CTA bottom */
    .dl-cta { padding: 70px 0; background: var(--green-50); text-align: center; }
    .dl-cta h2 { font-size: 1.9rem; font-weight: 900; color: var(--green-900); margin-bottom: .75rem; }
    .dl-cta p { font-size: .97rem; color: var(--text-mid); margin-bottom: 2.5rem; line-height: 1.8; max-width: 520px; margin-left: auto; margin-right: auto; }

    @media (max-width: 768px) {
        .dl-mockup-section { padding: 50px 0; }
        .dl-stats { padding: 50px 0; }
        .dl-cta { padding: 50px 0; }
        .dl-hero { padding: 80px 0 50px; }
        .dl-mockup-inner { grid-template-columns: 1fr; text-align: center; gap: 2.5rem; }
        .dl-mockup-inner .dl-features { order: -1; }
        .dl-feat-item { text-align: right; }
        .dl-stats-grid { grid-template-columns: 1fr 1fr; }
        .dl-phone { width: 220px; }
        .dl-features h2 { font-size: 1.4rem; }
        .dl-cta h2 { font-size: 1.5rem; }
    }
    @media (max-width: 480px) {
        .dl-badges { flex-direction: column; align-items: center; }
        .dl-badge { width: 100%; max-width: 280px; justify-content: center; }
        .dl-stats-grid { grid-template-columns: 1fr 1fr; gap: .75rem; }
        .dl-stat-card { padding: 1.25rem .75rem; }
        .dl-stat-card .num { font-size: 1.7rem; }
        .dl-phone { width: 200px; }
    }
    @media (max-width: 360px) {
        .dl-stats-grid { grid-template-columns: 1fr; }
        .dl-badge { max-width: 100%; }
        .dl-phone { width: 180px; }
        .dl-hero h1 { font-size: 1.6rem; }
    }
</style>
@endsection

@section('content')

<!-- HERO -->
<section class="dl-hero">
    <div class="container" style="position:relative;z-index:1;">
        <div class="dl-hero-tag">
            <span style="width:7px;height:7px;background:#4ade80;border-radius:50%;animation:pulse 2s infinite;display:inline-block;"></span>
            متاح الآن للتنزيل
        </div>
        <h1>حمّل تطبيق ميري<br>واستمتع بتجربة متكاملة</h1>
        <p>إدارة طلبات الاستقدام، متابعة الحالات، والتواصل مع مكاتب الاستقدام — كل ذلك في راحة يدك</p>
        <div class="dl-badges">
            <a href="#" class="dl-badge">
                <span class="dl-badge-icon">🍎</span>
                <span class="dl-badge-text">
                    <span class="dl-badge-sub">تنزيل من</span>
                    <span class="dl-badge-main">App Store</span>
                </span>
            </a>
            <a href="#" class="dl-badge dark">
                <span class="dl-badge-icon">▶</span>
                <span class="dl-badge-text">
                    <span class="dl-badge-sub">تنزيل من</span>
                    <span class="dl-badge-main">Google Play</span>
                </span>
            </a>
        </div>
    </div>
</section>

<!-- MOCKUP + FEATURES -->
<section class="dl-mockup-section">
    <div class="container">
        <div class="dl-mockup-inner">

            <!-- Phone mockup -->
            <div>
                <div class="dl-phone">
                    <div class="dl-phone-notch"></div>
                    <div class="dl-phone-screen">
                        <div class="phone-header">
                            <div class="phone-header-logo">م</div>
                            <span class="phone-header-title">نظام ميري</span>
                        </div>
                        <div class="phone-body">
                            <div class="phone-card">
                                <span class="phone-card-icon">📋</span>
                                <span class="phone-card-text">طلباتي النشطة</span>
                            </div>
                            <div class="phone-stat-row">
                                <div class="phone-stat">
                                    <span class="phone-stat-num">12</span>
                                    <span class="phone-stat-lbl">طلب جديد</span>
                                </div>
                                <div class="phone-stat">
                                    <span class="phone-stat-num">98%</span>
                                    <span class="phone-stat-lbl">نسبة الإنجاز</span>
                                </div>
                            </div>
                            <div class="phone-card">
                                <span class="phone-card-icon">🔔</span>
                                <span class="phone-card-text">3 إشعارات جديدة</span>
                            </div>
                            <div class="phone-card">
                                <span class="phone-card-icon">📊</span>
                                <span class="phone-card-text">تقرير الأداء الشهري</span>
                            </div>
                            <div class="phone-btn">عرض جميع الطلبات</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="dl-features">
                <h2>كل ما تحتاجه<br>في تطبيق واحد</h2>
                <p>صمّمنا التطبيق ليكون بسيطاً وسريعاً وفعّالاً — سواء كنت مستخدماً أو تدير مكتب استقدام</p>
                <div class="dl-feat-list">
                    <div class="dl-feat-item">
                        <div class="dl-feat-badge" style="background:#dcfce7">📋</div>
                        <div>
                            <h3>تتبع الطلبات لحظة بلحظة</h3>
                            <p>راقب حالة كل طلب من تقديمه حتى إتمامه بتحديثات فورية</p>
                        </div>
                    </div>
                    <div class="dl-feat-item">
                        <div class="dl-feat-badge" style="background:#dbeafe">🔔</div>
                        <div>
                            <h3>إشعارات فورية ذكية</h3>
                            <p>لا تفوّتك أي تحديث — إشعارات push فورية لكل مستجد</p>
                        </div>
                    </div>
                    <div class="dl-feat-item">
                        <div class="dl-feat-badge" style="background:#fef3c7">💬</div>
                        <div>
                            <h3>تواصل مباشر مع المكاتب</h3>
                            <p>راسل المكتب مباشرةً واستلم الردود دون الحاجة للزيارة</p>
                        </div>
                    </div>
                    <div class="dl-feat-item">
                        <div class="dl-feat-badge" style="background:#f0fdf4">🛡️</div>
                        <div>
                            <h3>حماية وأمان تام</h3>
                            <p>بياناتك مشفرة وآمنة على مدار الساعة بأعلى معايير الحماية</p>
                        </div>
                    </div>
                    <div class="dl-feat-item">
                        <div class="dl-feat-badge" style="background:#ede9fe">📄</div>
                        <div>
                            <h3>إدارة المستندات بسهولة</h3>
                            <p>رفع وتصفح جميع وثائقك ومستنداتك من هاتفك في أي وقت</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- STATS -->
<section class="dl-stats">
    <div class="container">
        <div style="text-align:center;margin-bottom:3rem;">
            <div class="page-header-tag" style="display:inline-block;background:var(--green-100);color:var(--green-800);padding:.3rem 1rem;border-radius:50px;font-size:.82rem;font-weight:700;margin-bottom:.75rem;">📊 بالأرقام</div>
            <h2 style="font-size:1.7rem;font-weight:900;color:var(--text-dark);">ثقة +500 مكتب استقدام</h2>
        </div>
        <div class="dl-stats-grid">
            <div class="dl-stat-card"><span class="num">+500</span><span class="lbl">مكتب استقدام</span></div>
            <div class="dl-stat-card"><span class="num">+10K</span><span class="lbl">سيرة ذاتية</span></div>
            <div class="dl-stat-card"><span class="num">99%</span><span class="lbl">رضا المستخدمين</span></div>
            <div class="dl-stat-card"><span class="num">24/7</span><span class="lbl">دعم فني مستمر</span></div>
        </div>
    </div>
</section>

<!-- BOTTOM CTA -->
<section class="dl-cta">
    <div class="container">
        <h2>جاهز للبداية؟ 🚀</h2>
        <p>انضم إلى آلاف المستخدمين الذين يديرون معاملاتهم بكل سهولة عبر تطبيق ميري</p>
        <div class="dl-badges">
            <a href="#" class="dl-badge">
                <span class="dl-badge-icon">🍎</span>
                <span class="dl-badge-text">
                    <span class="dl-badge-sub">تنزيل من</span>
                    <span class="dl-badge-main">App Store</span>
                </span>
            </a>
            <a href="#" class="dl-badge dark">
                <span class="dl-badge-icon">▶</span>
                <span class="dl-badge-text">
                    <span class="dl-badge-sub">تنزيل من</span>
                    <span class="dl-badge-main">Google Play</span>
                </span>
            </a>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<style>
@keyframes pulse { 0%,100%{transform:scale(1);opacity:1} 50%{transform:scale(1.5);opacity:.6} }
</style>
@endsection
