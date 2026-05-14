@extends('layouts.site')

@section('title', 'تنزيل تطبيق ميري')

@section('styles')
<style>
/* ════════════════════════════════
   DOWNLOAD PAGE — FULL REDESIGN
════════════════════════════════ */

/* ── HERO ── */
.dl-hero {
    padding: calc(var(--nav-height) + 56px) 0 72px;
    background-color: #052e16;
    background-image: linear-gradient(145deg, #052e16 0%, #0a5c30 55%, #15803d 100%);
    text-align: center; position: relative; overflow: hidden;
}
/* decorative orbs */
.dl-hero::before,
.dl-hero::after {
    content: ''; position: absolute; border-radius: 50%; pointer-events: none;
}
.dl-hero::before {
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(74,222,128,.12) 0%, transparent 70%);
    top: -120px; right: -100px;
}
.dl-hero::after {
    width: 360px; height: 360px;
    background: radial-gradient(circle, rgba(255,255,255,.06) 0%, transparent 70%);
    bottom: -80px; left: -60px;
}
.dl-hero-inner { position: relative; z-index: 1; }

.dl-live-tag {
    display: inline-flex; align-items: center; gap: .55rem;
    background: rgba(74,222,128,.15); color: #4ade80;
    border: 1px solid rgba(74,222,128,.3);
    padding: .4rem 1.2rem; border-radius: 50px;
    font-size: .82rem; font-weight: 700; margin-bottom: 1.75rem;
    letter-spacing: .02em;
}
.dl-live-dot {
    width: 8px; height: 8px; background: #4ade80; border-radius: 50%;
    animation: livePulse 2s ease-in-out infinite;
}
.dl-hero h1 {
    font-size: clamp(2.1rem, 5.5vw, 3.6rem); font-weight: 900;
    color: var(--white); line-height: 1.2; margin-bottom: 1.1rem;
}
.dl-hero h1 .hl { color: #4ade80; }
.dl-hero > .dl-hero-inner > p {
    font-size: 1.05rem; color: rgba(255,255,255,.75);
    line-height: 1.9; max-width: 520px; margin: 0 auto 2.75rem;
}

/* ── STORE BADGES ── */
.dl-store-row { display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap; }
.dl-store-btn {
    display: inline-flex; align-items: center; gap: .9rem;
    padding: .85rem 2rem; border-radius: 16px;
    text-decoration: none; font-family: 'Tajawal', sans-serif;
    transition: transform .25s, box-shadow .25s;
    min-width: 200px;
}
.dl-store-btn:hover { transform: translateY(-4px); }
.dl-store-btn.ios {
    background: var(--white); color: var(--text-dark);
    box-shadow: 0 8px 32px rgba(0,0,0,.18);
}
.dl-store-btn.ios:hover { box-shadow: 0 16px 48px rgba(0,0,0,.25); }
.dl-store-btn.android {
    background: #1c1c1e; color: var(--white);
    box-shadow: 0 8px 32px rgba(0,0,0,.35);
}
.dl-store-btn.android:hover { box-shadow: 0 16px 48px rgba(0,0,0,.45); }
.store-icon { font-size: 2rem; flex-shrink: 0; }
.store-text { display: flex; flex-direction: column; text-align: right; }
.store-sub { font-size: .68rem; font-weight: 400; opacity: .65; }
.store-name { font-size: 1.1rem; font-weight: 900; letter-spacing: -.01em; }
.dl-store-btn.ios .store-name { color: var(--text-dark); }
.dl-store-btn.android .store-name { color: var(--white); }

/* rating strip below buttons */
.dl-rating {
    margin-top: 1.75rem;
    display: flex; align-items: center; justify-content: center; gap: 1.5rem;
    flex-wrap: wrap;
}
.dl-rating-item { display: flex; align-items: center; gap: .4rem; color: rgba(255,255,255,.55); font-size: .82rem; font-weight: 600; }
.dl-rating-item .stars { color: #fbbf24; font-size: .9rem; }
.dl-rating-divider { width: 1px; height: 16px; background: rgba(255,255,255,.2); }

/* ── MOCKUP + FEATURES ── */
.dl-mockup-section { padding: var(--page-section-padding) 0; background: var(--green-50); }
.dl-mockup-grid {
    display: grid; grid-template-columns: 1fr 1.1fr; gap: 5rem; align-items: center;
}

/* phone */
.dl-phone-wrap { display: flex; justify-content: center; position: relative; }
.dl-phone-glow {
    position: absolute; inset: -30px; border-radius: 60px;
    background: radial-gradient(circle at center, rgba(21,128,61,.18) 0%, transparent 70%);
    pointer-events: none;
}
.dl-phone {
    width: 270px; background: var(--green-900); border-radius: 44px;
    padding: 14px; box-shadow: 0 48px 96px rgba(5,46,22,.4);
    position: relative; z-index: 1;
}
.dl-phone-notch {
    width: 90px; height: 24px; background: var(--green-900);
    border-radius: 0 0 16px 16px; margin: 0 auto 6px;
}
.dl-phone-screen {
    background: #f8fafc; border-radius: 32px;
    overflow: hidden; aspect-ratio: 9/19.5;
    display: flex; flex-direction: column;
}
.ph-header {
    background: var(--green-800); padding: 1rem 1rem .8rem;
    display: flex; align-items: center; gap: .6rem;
}
.ph-logo {
    width: 30px; height: 30px; background: var(--white);
    border-radius: 8px; display: flex; align-items: center;
    justify-content: center; font-size: .85rem; font-weight: 900; color: var(--green-800);
}
.ph-title { color: var(--white); font-size: .82rem; font-weight: 800; }
.ph-body { padding: .8rem; display: flex; flex-direction: column; gap: .55rem; flex: 1; }
.ph-greeting { font-size: .68rem; color: var(--text-light); font-weight: 600; padding: .2rem 0 .1rem; }
.ph-stat-row { display: grid; grid-template-columns: 1fr 1fr; gap: .5rem; }
.ph-stat {
    background: var(--white); border: 1px solid var(--border);
    border-radius: 12px; padding: .7rem .6rem; text-align: center;
}
.ph-stat-num { font-size: 1.05rem; font-weight: 900; color: var(--green-800); display: block; }
.ph-stat-lbl { font-size: .52rem; color: var(--text-light); display: block; margin-top: .1rem; }
.ph-card {
    background: var(--white); border-radius: 12px; padding: .6rem .75rem;
    display: flex; align-items: center; gap: .55rem;
    border: 1px solid var(--border);
}
.ph-card-icon { font-size: 1rem; flex-shrink: 0; }
.ph-card-body { flex: 1; min-width: 0; }
.ph-card-title { font-size: .63rem; font-weight: 800; color: var(--text-dark); display: block; }
.ph-card-sub { font-size: .54rem; color: var(--text-light); display: block; margin-top: .1rem; }
.ph-card-badge {
    font-size: .5rem; font-weight: 800; background: var(--green-100);
    color: var(--green-800); padding: .15rem .4rem; border-radius: 50px; flex-shrink: 0;
}
.ph-btn {
    background: linear-gradient(135deg, var(--green-700), var(--green-600));
    color: var(--white); text-align: center; padding: .65rem;
    border-radius: 12px; font-size: .7rem; font-weight: 800; margin-top: .15rem;
    letter-spacing: .01em;
}

/* features list */
.dl-features-col { }
.dl-feat-eyebrow {
    display: inline-block; background: var(--green-100); color: var(--green-800);
    padding: .28rem .9rem; border-radius: 50px; font-size: .78rem; font-weight: 700;
    margin-bottom: .9rem;
}
.dl-features-col h2 {
    font-size: clamp(1.6rem, 3vw, 2.1rem); font-weight: 900;
    color: var(--text-dark); line-height: 1.3; margin-bottom: .65rem;
}
.dl-features-col > p {
    font-size: .95rem; color: var(--text-mid); line-height: 1.9; margin-bottom: 2rem;
}
.dl-feat-list { display: flex; flex-direction: column; gap: .85rem; }
.dl-feat-item {
    display: flex; align-items: flex-start; gap: 1rem;
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: var(--radius-lg); padding: 1rem 1.1rem;
    transition: border-color .2s, box-shadow .2s;
}
.dl-feat-item:hover { border-color: var(--green-400); box-shadow: 0 4px 16px rgba(21,128,61,.1); }
.dl-feat-icon {
    width: 46px; height: 46px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; flex-shrink: 0;
}
.dl-feat-item h3 { font-size: .92rem; font-weight: 800; color: var(--text-dark); margin-bottom: .2rem; }
.dl-feat-item p { font-size: .83rem; color: var(--text-light); line-height: 1.65; }

/* ── STATS BAND ── */
.dl-stats {
    padding: var(--page-section-padding) 0;
    background: var(--green-900);
    position: relative; overflow: hidden;
}
.dl-stats::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at 30% 50%, rgba(74,222,128,.08) 0%, transparent 60%);
    pointer-events: none;
}
.dl-stats-head { text-align: center; margin-bottom: 3rem; position: relative; z-index: 1; }
.dl-stats-tag {
    display: inline-block; background: rgba(74,222,128,.15); color: #4ade80;
    border: 1px solid rgba(74,222,128,.3);
    padding: .3rem .9rem; border-radius: 50px; font-size: .8rem; font-weight: 700;
    margin-bottom: .8rem;
}
.dl-stats-head h2 { font-size: clamp(1.6rem, 3vw, 2.1rem); font-weight: 900; color: var(--white); }
.dl-stats-head p { font-size: .9rem; color: rgba(255,255,255,.5); margin-top: .4rem; }

.dl-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; position: relative; z-index: 1; }
.dl-stat-card {
    background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1);
    border-radius: var(--radius-lg); padding: 2rem 1.25rem; text-align: center;
    transition: background .3s, transform .3s;
}
.dl-stat-card:hover { background: rgba(255,255,255,.09); transform: translateY(-4px); }
.dl-stat-card .num {
    font-size: 2.4rem; font-weight: 900; display: block; margin-bottom: .4rem;
    background: linear-gradient(135deg, #4ade80, #86efac);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}
.dl-stat-card .lbl { font-size: .85rem; color: rgba(255,255,255,.5); }
.dl-stat-card .stat-icon { font-size: 1.6rem; margin-bottom: .6rem; display: block; }

/* ── BOTTOM CTA ── */
.dl-cta { padding: var(--page-section-padding) 0; background: var(--green-50); }
.dl-cta-card {
    background: linear-gradient(135deg, var(--green-900) 0%, #0a5c30 60%, var(--green-700) 100%);
    border-radius: 28px; padding: 3.5rem 3rem;
    text-align: center; position: relative; overflow: hidden;
    box-shadow: 0 24px 64px rgba(5,46,22,.3);
}
.dl-cta-card::before {
    content: ''; position: absolute;
    width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(255,255,255,.04) 0%, transparent 70%);
    top: -150px; left: -100px; pointer-events: none;
}
.dl-cta-card h2 {
    font-size: clamp(1.7rem, 4vw, 2.4rem); font-weight: 900; color: var(--white);
    margin-bottom: .75rem; position: relative;
}
.dl-cta-card p {
    font-size: .97rem; color: rgba(255,255,255,.7); line-height: 1.85;
    max-width: 500px; margin: 0 auto 2.5rem; position: relative;
}

/* ── RESPONSIVE ── */
@media (max-width: 1024px) {
    .dl-mockup-grid { gap: 3rem; }
}
@media (max-width: 768px) {
    .dl-hero { padding: calc(var(--nav-height) + 36px) 0 56px; }
    .dl-mockup-section { padding: var(--page-section-padding-mobile) 0; }
    .dl-stats { padding: var(--page-section-padding-mobile) 0; }
    .dl-cta { padding: var(--page-section-padding-mobile) 0; }
    .dl-mockup-grid { grid-template-columns: 1fr; text-align: center; gap: 3rem; }
    .dl-features-col { order: -1; }
    .dl-feat-item { text-align: right; }
    .dl-stats-grid { grid-template-columns: 1fr 1fr; }
    .dl-phone { width: 230px; }
    .dl-cta-card { padding: 2.5rem 1.5rem; border-radius: 20px; }
}
@media (max-width: 480px) {
    .dl-store-row { flex-direction: column; align-items: center; }
    .dl-store-btn { width: 100%; max-width: 280px; justify-content: center; }
    .dl-stats-grid { grid-template-columns: 1fr 1fr; gap: .75rem; }
    .dl-stat-card { padding: 1.5rem .75rem; }
    .dl-stat-card .num { font-size: 1.9rem; }
    .dl-phone { width: 210px; }
    .dl-rating { gap: .75rem; }
    .dl-rating-divider { display: none; }
}
@media (max-width: 360px) {
    .dl-stats-grid { grid-template-columns: 1fr; }
    .dl-phone { width: 190px; }
    .dl-store-btn { max-width: 100%; }
}

@keyframes livePulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.4)} }
</style>
@endsection

@section('content')

<!-- ══════════ HERO ══════════ -->
<section class="dl-hero">
    <div class="container dl-hero-inner">
        <div class="dl-live-tag">
            <span class="dl-live-dot"></span>
            متاح الآن للتنزيل المجاني
        </div>
        <h1>حمّل تطبيق <span class="hl">ميري</span><br>واستمتع بتجربة متكاملة</h1>
        <p>إدارة طلبات الاستقدام، متابعة الحالات، والتواصل مع مكاتب الاستقدام — كل ذلك في راحة يدك</p>

        <div class="dl-store-row">
            <a href="#" class="dl-store-btn ios">
                <span class="store-icon">🍎</span>
                <span class="store-text">
                    <span class="store-sub">تنزيل من</span>
                    <span class="store-name">App Store</span>
                </span>
            </a>
            <a href="#" class="dl-store-btn android">
                <span class="store-icon">▶</span>
                <span class="store-text">
                    <span class="store-sub">تنزيل من</span>
                    <span class="store-name">Google Play</span>
                </span>
            </a>
        </div>

        <div class="dl-rating">
            <div class="dl-rating-item">
                <span class="stars">★★★★★</span>
                <span>4.9 تقييم App Store</span>
            </div>
            <div class="dl-rating-divider"></div>
            <div class="dl-rating-item">
                <span class="stars">★★★★★</span>
                <span>4.8 تقييم Google Play</span>
            </div>
            <div class="dl-rating-divider"></div>
            <div class="dl-rating-item">
                <span>+10,000 تنزيل</span>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ MOCKUP + FEATURES ══════════ -->
<section class="dl-mockup-section">
    <div class="container">
        <div class="dl-mockup-grid">

            <!-- Phone mockup -->
            <div class="dl-phone-wrap">
                <div class="dl-phone-glow"></div>
                <div class="dl-phone">
                    <div class="dl-phone-notch"></div>
                    <div class="dl-phone-screen">
                        <div class="ph-header">
                            <div class="ph-logo">م</div>
                            <span class="ph-title">نظام ميري</span>
                        </div>
                        <div class="ph-body">
                            <span class="ph-greeting">مرحباً، أحمد 👋</span>
                            <div class="ph-stat-row">
                                <div class="ph-stat">
                                    <span class="ph-stat-num">12</span>
                                    <span class="ph-stat-lbl">طلب نشط</span>
                                </div>
                                <div class="ph-stat">
                                    <span class="ph-stat-num">98%</span>
                                    <span class="ph-stat-lbl">نسبة الإنجاز</span>
                                </div>
                            </div>
                            <div class="ph-card">
                                <span class="ph-card-icon">📋</span>
                                <div class="ph-card-body">
                                    <span class="ph-card-title">طلبات الاستقدام</span>
                                    <span class="ph-card-sub">3 طلبات تحت المراجعة</span>
                                </div>
                                <span class="ph-card-badge">جديد</span>
                            </div>
                            <div class="ph-card">
                                <span class="ph-card-icon">🔔</span>
                                <div class="ph-card-body">
                                    <span class="ph-card-title">الإشعارات</span>
                                    <span class="ph-card-sub">3 إشعارات غير مقروءة</span>
                                </div>
                                <span class="ph-card-badge">3</span>
                            </div>
                            <div class="ph-card">
                                <span class="ph-card-icon">📊</span>
                                <div class="ph-card-body">
                                    <span class="ph-card-title">تقرير الأداء</span>
                                    <span class="ph-card-sub">يناير — ديسمبر 2025</span>
                                </div>
                            </div>
                            <div class="ph-btn">عرض جميع الطلبات ←</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="dl-features-col">
                <span class="dl-feat-eyebrow">✦ مميزات التطبيق</span>
                <h2>كل ما تحتاجه<br>في تطبيق واحد</h2>
                <p>صمّمنا ميري ليكون بسيطاً وسريعاً — سواء كنت مستخدماً أو تدير مكتب استقدام</p>
                <div class="dl-feat-list">
                    <div class="dl-feat-item">
                        <div class="dl-feat-icon" style="background:#dcfce7">📋</div>
                        <div>
                            <h3>تتبع الطلبات لحظة بلحظة</h3>
                            <p>راقب حالة كل طلب من تقديمه حتى إتمامه بتحديثات فورية</p>
                        </div>
                    </div>
                    <div class="dl-feat-item">
                        <div class="dl-feat-icon" style="background:#dbeafe">🔔</div>
                        <div>
                            <h3>إشعارات Push فورية</h3>
                            <p>لا تفوّتك أي تحديث — إشعارات ذكية لكل مستجد في طلبك</p>
                        </div>
                    </div>
                    <div class="dl-feat-item">
                        <div class="dl-feat-icon" style="background:#fef3c7">💬</div>
                        <div>
                            <h3>تواصل مباشر مع المكاتب</h3>
                            <p>راسل المكتب واستلم الردود دون الحاجة للزيارة الشخصية</p>
                        </div>
                    </div>
                    <div class="dl-feat-item">
                        <div class="dl-feat-icon" style="background:#f0fdf4">🛡️</div>
                        <div>
                            <h3>حماية وأمان تام</h3>
                            <p>بياناتك مشفرة وآمنة على مدار الساعة بأعلى معايير الحماية</p>
                        </div>
                    </div>
                    <div class="dl-feat-item">
                        <div class="dl-feat-icon" style="background:#ede9fe">📄</div>
                        <div>
                            <h3>إدارة المستندات بسهولة</h3>
                            <p>رفع وتصفح جميع وثائقك من هاتفك في أي وقت ومن أي مكان</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══════════ STATS ══════════ -->
<section class="dl-stats">
    <div class="container">
        <div class="dl-stats-head">
            <div class="dl-stats-tag">📊 بالأرقام</div>
            <h2>ثقة آلاف المستخدمين حول المملكة</h2>
            <p>أرقام حقيقية تعكس تأثير ميري في قطاع الاستقدام</p>
        </div>
        <div class="dl-stats-grid">
            <div class="dl-stat-card">
                <span class="stat-icon">🏢</span>
                <span class="num">+500</span>
                <span class="lbl">مكتب استقدام</span>
            </div>
            <div class="dl-stat-card">
                <span class="stat-icon">📄</span>
                <span class="num">+10K</span>
                <span class="lbl">سيرة ذاتية</span>
            </div>
            <div class="dl-stat-card">
                <span class="stat-icon">⭐</span>
                <span class="num">99%</span>
                <span class="lbl">رضا المستخدمين</span>
            </div>
            <div class="dl-stat-card">
                <span class="stat-icon">🕐</span>
                <span class="num">24/7</span>
                <span class="lbl">دعم فني مستمر</span>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ BOTTOM CTA ══════════ -->
<section class="dl-cta">
    <div class="container">
        <div class="dl-cta-card">
            <h2>جاهز للبداية؟ 🚀</h2>
            <p>انضم إلى آلاف المستخدمين الذين يديرون معاملاتهم بكل سهولة عبر تطبيق ميري — مجاناً تماماً</p>
            <div class="dl-store-row">
                <a href="#" class="dl-store-btn ios">
                    <span class="store-icon">🍎</span>
                    <span class="store-text">
                        <span class="store-sub">تنزيل من</span>
                        <span class="store-name">App Store</span>
                    </span>
                </a>
                <a href="#" class="dl-store-btn android">
                    <span class="store-icon">▶</span>
                    <span class="store-text">
                        <span class="store-sub">تنزيل من</span>
                        <span class="store-name">Google Play</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
