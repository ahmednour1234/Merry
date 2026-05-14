@extends('layouts.site')

@section('title', 'تنزيل تطبيق ميري')

@section('styles')
<style>
/* ═══════════════════════════════
   DOWNLOAD PAGE — REDESIGN v3
═══════════════════════════════ */

/* ── HERO ── */
.dl-hero {
    padding: calc(var(--nav-height) + 64px) 0 80px;
    background-color: #052e16;
    background-image:
        radial-gradient(ellipse 80% 60% at 70% -10%, rgba(74,222,128,.13) 0%, transparent 60%),
        radial-gradient(ellipse 60% 50% at -10% 80%, rgba(255,255,255,.04) 0%, transparent 55%),
        linear-gradient(160deg, #052e16 0%, #083d20 45%, #0f5c2e 100%);
    text-align: center; position: relative; overflow: hidden;
}
/* dot grid overlay */
.dl-hero::before {
    content: '';
    position: absolute; inset: 0; pointer-events: none;
    background-image: radial-gradient(circle, rgba(255,255,255,.07) 1px, transparent 1px);
    background-size: 28px 28px;
    mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
    -webkit-mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
}
.dl-hero-inner { position: relative; z-index: 1; }

/* live badge */
.dl-live-tag {
    display: inline-flex; align-items: center; gap: .5rem;
    background: rgba(74,222,128,.12); color: #4ade80;
    border: 1px solid rgba(74,222,128,.28);
    padding: .38rem 1.1rem; border-radius: 50px;
    font-size: .8rem; font-weight: 700; margin-bottom: 1.6rem;
    letter-spacing: .03em; backdrop-filter: blur(4px);
}
.dl-live-dot {
    width: 7px; height: 7px; background: #4ade80; border-radius: 50%;
    animation: livePulse 2s ease-in-out infinite; flex-shrink: 0;
}

/* heading */
.dl-hero h1 {
    font-size: clamp(2.2rem, 6vw, 3.8rem); font-weight: 900;
    color: #ffffff; line-height: 1.18; margin-bottom: 1rem;
    letter-spacing: -.02em;
}
.dl-hero h1 .hl {
    background: linear-gradient(135deg, #4ade80, #86efac);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}
.dl-hero-sub {
    font-size: 1.05rem; color: rgba(255,255,255,.68);
    line-height: 1.9; max-width: 500px; margin: 0 auto 2.8rem;
}

/* ── STORE BUTTONS ── */
.dl-store-row {
    display: flex; align-items: center; justify-content: center;
    gap: .9rem; flex-wrap: wrap;
}
.dl-store-btn {
    display: inline-flex; align-items: center; gap: .85rem;
    padding: .9rem 1.7rem; border-radius: 18px;
    text-decoration: none; font-family: 'Tajawal', sans-serif;
    transition: transform .25s ease, box-shadow .25s ease;
    min-width: 190px; direction: ltr;
}
.dl-store-btn:hover { transform: translateY(-3px); }
.dl-store-btn.ios {
    background: #ffffff; color: #0f172a;
    box-shadow: 0 6px 28px rgba(0,0,0,.22);
}
.dl-store-btn.ios:hover { box-shadow: 0 14px 44px rgba(0,0,0,.28); }
.dl-store-btn.android {
    background: #1a1a1a; color: #ffffff;
    box-shadow: 0 6px 28px rgba(0,0,0,.4);
}
.dl-store-btn.android:hover { box-shadow: 0 14px 44px rgba(0,0,0,.5); }
.store-svg { flex-shrink: 0; display: flex; align-items: center; }
.store-text-col { display: flex; flex-direction: column; text-align: left; }
.store-sub { font-size: .62rem; font-weight: 500; opacity: .6; line-height: 1; }
.store-name { font-size: 1.05rem; font-weight: 900; line-height: 1.2; margin-top: .15rem; }

/* ── TRUST STRIP ── */
.dl-trust {
    margin-top: 2rem;
    display: flex; align-items: center; justify-content: center;
    gap: 1rem; flex-wrap: wrap;
}
.dl-trust-chip {
    display: inline-flex; align-items: center; gap: .45rem;
    background: rgba(255,255,255,.07); backdrop-filter: blur(6px);
    border: 1px solid rgba(255,255,255,.12);
    padding: .38rem .9rem; border-radius: 50px;
    color: rgba(255,255,255,.7); font-size: .77rem; font-weight: 600;
}
.dl-trust-chip .stars { color: #fbbf24; letter-spacing: -.05em; }
.dl-trust-sep { width: 1px; height: 18px; background: rgba(255,255,255,.15); }

/* ── FEATURES SECTION ── */
.dl-features-section {
    padding: var(--page-section-padding) 0;
    background: #f8fffe;
}
.dl-section-head { text-align: center; margin-bottom: 3rem; }
.dl-eyebrow {
    display: inline-block; background: #dcfce7; color: #15803d;
    padding: .3rem .95rem; border-radius: 50px;
    font-size: .78rem; font-weight: 800; margin-bottom: .85rem; letter-spacing: .02em;
}
.dl-section-head h2 {
    font-size: clamp(1.7rem, 3.5vw, 2.3rem); font-weight: 900;
    color: #0f172a; line-height: 1.25; margin-bottom: .55rem;
}
.dl-section-head p { font-size: .97rem; color: #6b7280; line-height: 1.8; max-width: 520px; margin: 0 auto; }
.dl-feat-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem;
}
.dl-feat-card {
    background: #ffffff; border: 1.5px solid #e5e7eb;
    border-radius: 20px; padding: 1.6rem 1.4rem;
    transition: border-color .2s, box-shadow .2s, transform .2s;
}
.dl-feat-card:hover {
    border-color: #4ade80; transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(21,128,61,.1);
}
.dl-feat-card-icon {
    width: 52px; height: 52px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; margin-bottom: 1.1rem;
}
.dl-feat-card h3 { font-size: .97rem; font-weight: 800; color: #111827; margin-bottom: .4rem; }
.dl-feat-card p { font-size: .84rem; color: #6b7280; line-height: 1.7; }

/* ── STATS ── */
.dl-stats {
    padding: var(--page-section-padding) 0;
    background: #052e16; position: relative; overflow: hidden;
}
.dl-stats::before {
    content: ''; position: absolute; inset: 0; pointer-events: none;
    background-image: radial-gradient(circle, rgba(74,222,128,.06) 1px, transparent 1px);
    background-size: 32px 32px;
}
.dl-stats::after {
    content: ''; position: absolute;
    width: 600px; height: 600px; border-radius: 50%; pointer-events: none;
    background: radial-gradient(circle, rgba(74,222,128,.1) 0%, transparent 65%);
    top: -200px; right: -150px;
}
.dl-stats-head { text-align: center; margin-bottom: 2.75rem; position: relative; z-index: 1; }
.dl-stats-tag {
    display: inline-block; background: rgba(74,222,128,.14); color: #4ade80;
    border: 1px solid rgba(74,222,128,.28);
    padding: .3rem .95rem; border-radius: 50px; font-size: .79rem; font-weight: 700;
    margin-bottom: .8rem;
}
.dl-stats-head h2 {
    font-size: clamp(1.6rem, 3.5vw, 2.2rem); font-weight: 900; color: #ffffff; margin-bottom: .4rem;
}
.dl-stats-head p { font-size: .9rem; color: rgba(255,255,255,.45); }
.dl-stats-grid {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;
    position: relative; z-index: 1;
}
.dl-stat-card {
    background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.09);
    border-radius: 20px; padding: 2rem 1rem; text-align: center;
    transition: background .25s, transform .25s;
}
.dl-stat-card:hover { background: rgba(255,255,255,.1); transform: translateY(-4px); }
.dl-stat-icon { font-size: 1.7rem; display: block; margin-bottom: .65rem; }
.dl-stat-num {
    font-size: 2.3rem; font-weight: 900; display: block; margin-bottom: .3rem;
    background: linear-gradient(135deg, #4ade80 0%, #86efac 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
}
.dl-stat-lbl { font-size: .84rem; color: rgba(255,255,255,.45); display: block; }

/* ── BOTTOM CTA ── */
.dl-cta { padding: var(--page-section-padding) 0; background: #f0fdf4; }
.dl-cta-card {
    background: linear-gradient(150deg, #052e16 0%, #0a5c30 55%, #15803d 100%);
    border-radius: 28px; padding: 4rem 3rem; text-align: center;
    position: relative; overflow: hidden;
    box-shadow: 0 28px 80px rgba(5,46,22,.35);
}
.dl-cta-card::before {
    content: ''; position: absolute; inset: 0; pointer-events: none;
    background-image: radial-gradient(circle, rgba(255,255,255,.05) 1px, transparent 1px);
    background-size: 24px 24px;
}
.dl-cta-card::after {
    content: ''; position: absolute; pointer-events: none;
    width: 500px; height: 500px; border-radius: 50%;
    background: radial-gradient(circle, rgba(74,222,128,.1) 0%, transparent 70%);
    top: -200px; left: -100px;
}
.dl-cta-card h2 {
    font-size: clamp(1.8rem, 4.5vw, 2.6rem); font-weight: 900; color: #ffffff;
    margin-bottom: .7rem; position: relative; z-index: 1; letter-spacing: -.01em;
}
.dl-cta-card p {
    font-size: .97rem; color: rgba(255,255,255,.65); line-height: 1.85;
    max-width: 480px; margin: 0 auto 2.5rem; position: relative; z-index: 1;
}
.dl-cta-card .dl-store-row { position: relative; z-index: 1; }
/* white store btn inside dark cta */
.dl-cta-card .dl-store-btn.ios {
    background: rgba(255,255,255,.95);
    box-shadow: 0 6px 24px rgba(0,0,0,.25);
}
.dl-cta-card .dl-store-btn.android {
    background: rgba(0,0,0,.55); border: 1px solid rgba(255,255,255,.15);
}

/* ── RESPONSIVE ── */
@media (max-width: 1024px) {
    .dl-feat-grid { grid-template-columns: repeat(2, 1fr); }
    .dl-stats-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .dl-hero { padding: calc(var(--nav-height) + 40px) 0 60px; }
    .dl-features-section { padding: var(--page-section-padding-mobile) 0; }
    .dl-stats { padding: var(--page-section-padding-mobile) 0; }
    .dl-cta { padding: var(--page-section-padding-mobile) 0; }
    .dl-cta-card { padding: 2.8rem 1.75rem; border-radius: 22px; }
    .dl-feat-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
}
@media (max-width: 520px) {
    .dl-store-row { flex-direction: column; align-items: center; }
    .dl-store-btn { width: 100%; max-width: 300px; justify-content: center; }
    .dl-feat-grid { grid-template-columns: 1fr 1fr; gap: .85rem; }
    .dl-feat-card { padding: 1.25rem 1rem; }
    .dl-feat-card-icon { width: 44px; height: 44px; font-size: 1.3rem; border-radius: 12px; }
    .dl-feat-card h3 { font-size: .88rem; }
    .dl-feat-card p { font-size: .78rem; }
    .dl-stat-num { font-size: 1.9rem; }
    .dl-trust { gap: .6rem; }
    .dl-trust-sep { display: none; }
}
@media (max-width: 400px) {
    .dl-hero h1 { font-size: 2rem; }
    .dl-store-btn { max-width: 100%; }
    .dl-feat-grid { grid-template-columns: 1fr; }
    .dl-stats-grid { grid-template-columns: 1fr 1fr; }
    .dl-cta-card { padding: 2.2rem 1.25rem; border-radius: 18px; }
}

@keyframes livePulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.4;transform:scale(1.5)} }
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
        <p class="dl-hero-sub">إدارة طلبات الاستقدام، متابعة الحالات، والتواصل مع مكاتب الاستقدام — كل ذلك في راحة يدك</p>

        <div class="dl-store-row">
            <!-- App Store -->
            <a href="https://apps.apple.com/sa/app/meery-%D9%85%D9%8A%D8%B1%D9%8A/id6758953274" target="_blank" rel="noopener" class="dl-store-btn ios">
                <span class="store-svg">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="#000000"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
                </span>
                <span class="store-text-col">
                    <span class="store-sub">Download on the</span>
                    <span class="store-name">App Store</span>
                </span>
            </a>
            <!-- Google Play -->
            <a href="https://play.google.com/store/apps/details?id=com.mery.apppp" target="_blank" rel="noopener" class="dl-store-btn android">
                <span class="store-svg">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none"><path d="M3.18 23.77A2 2 0 0 1 2 22V2c0-.43.13-.83.36-1.16L13 12 3.18 23.77z" fill="#EA4335"/><path d="M16.93 8.34l-3.3-3.3-9.47-4.8A2.04 2.04 0 0 1 5.25 0l11.68 8.34z" fill="#FBBC04"/><path d="M16.93 15.66L5.25 24a2.04 2.04 0 0 1-1.09-.24L13 12l3.93 3.66z" fill="#34A853"/><path d="M22 12c0 .88-.48 1.66-1.2 2.1l-3.87 2.19L13 12l4.93-4.29 3.87 2.19A2.45 2.45 0 0 1 22 12z" fill="#4285F4"/></svg>
                </span>
                <span class="store-text-col">
                    <span class="store-sub" style="color:rgba(255,255,255,.6)">Get it on</span>
                    <span class="store-name" style="color:#ffffff">Google Play</span>
                </span>
            </a>
        </div>

        <div class="dl-trust">
            <div class="dl-trust-chip">
                <span class="stars">★★★★★</span>
                <span>4.9 — App Store</span>
            </div>
            <div class="dl-trust-sep"></div>
            <div class="dl-trust-chip">
                <span class="stars">★★★★★</span>
                <span>4.8 — Google Play</span>
            </div>
            <div class="dl-trust-sep"></div>
            <div class="dl-trust-chip">
                <span>+10,000 تنزيل</span>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ FEATURES GRID ══════════ -->
<section class="dl-features-section">
    <div class="container">
        <div class="dl-section-head">
            <span class="dl-eyebrow">✦ مميزات التطبيق</span>
            <h2>كل ما تحتاجه في تطبيق واحد</h2>
            <p>صمّمنا ميري ليكون بسيطاً وسريعاً — سواء كنت مستخدماً أو تدير مكتب استقدام</p>
        </div>
        <div class="dl-feat-grid">
            <div class="dl-feat-card">
                <div class="dl-feat-card-icon" style="background:#dcfce7">📋</div>
                <h3>تتبع الطلبات لحظة بلحظة</h3>
                <p>راقب حالة كل طلب من تقديمه حتى إتمامه بتحديثات فورية</p>
            </div>
            <div class="dl-feat-card">
                <div class="dl-feat-card-icon" style="background:#dbeafe">🔔</div>
                <h3>إشعارات Push فورية</h3>
                <p>لا تفوّتك أي تحديث — إشعارات ذكية لكل مستجد في طلبك</p>
            </div>
            <div class="dl-feat-card">
                <div class="dl-feat-card-icon" style="background:#fef3c7">💬</div>
                <h3>تواصل مباشر مع المكاتب</h3>
                <p>راسل المكتب واستلم الردود دون الحاجة للزيارة الشخصية</p>
            </div>
            <div class="dl-feat-card">
                <div class="dl-feat-card-icon" style="background:#f0fdf4">🛡️</div>
                <h3>حماية وأمان تام</h3>
                <p>بياناتك مشفرة وآمنة على مدار الساعة بأعلى معايير الحماية</p>
            </div>
            <div class="dl-feat-card">
                <div class="dl-feat-card-icon" style="background:#ede9fe">📄</div>
                <h3>إدارة المستندات</h3>
                <p>رفع وتصفح جميع وثائقك من هاتفك في أي وقت ومكان</p>
            </div>
            <div class="dl-feat-card">
                <div class="dl-feat-card-icon" style="background:#fff7ed">📊</div>
                <h3>تقارير وإحصاءات</h3>
                <p>اطّلع على تقارير أداء شاملة لمتابعة نشاطك باحترافية</p>
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
                <span class="dl-stat-icon">🏢</span>
                <span class="dl-stat-num">+500</span>
                <span class="dl-stat-lbl">مكتب استقدام</span>
            </div>
            <div class="dl-stat-card">
                <span class="dl-stat-icon">📄</span>
                <span class="dl-stat-num">+10K</span>
                <span class="dl-stat-lbl">سيرة ذاتية</span>
            </div>
            <div class="dl-stat-card">
                <span class="dl-stat-icon">⭐</span>
                <span class="dl-stat-num">99%</span>
                <span class="dl-stat-lbl">رضا المستخدمين</span>
            </div>
            <div class="dl-stat-card">
                <span class="dl-stat-icon">🕐</span>
                <span class="dl-stat-num">24/7</span>
                <span class="dl-stat-lbl">دعم فني مستمر</span>
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
                <a href="https://apps.apple.com/sa/app/meery-%D9%85%D9%8A%D8%B1%D9%8A/id6758953274" target="_blank" rel="noopener" class="dl-store-btn ios">
                    <span class="store-svg">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="#000000"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
                    </span>
                    <span class="store-text-col">
                        <span class="store-sub">Download on the</span>
                        <span class="store-name">App Store</span>
                    </span>
                </a>
                <a href="https://play.google.com/store/apps/details?id=com.mery.apppp" target="_blank" rel="noopener" class="dl-store-btn android">
                    <span class="store-svg">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none"><path d="M3.18 23.77A2 2 0 0 1 2 22V2c0-.43.13-.83.36-1.16L13 12 3.18 23.77z" fill="#EA4335"/><path d="M16.93 8.34l-3.3-3.3-9.47-4.8A2.04 2.04 0 0 1 5.25 0l11.68 8.34z" fill="#FBBC04"/><path d="M16.93 15.66L5.25 24a2.04 2.04 0 0 1-1.09-.24L13 12l3.93 3.66z" fill="#34A853"/><path d="M22 12c0 .88-.48 1.66-1.2 2.1l-3.87 2.19L13 12l4.93-4.29 3.87 2.19A2.45 2.45 0 0 1 22 12z" fill="#4285F4"/></svg>
                    </span>
                    <span class="store-text-col">
                        <span class="store-sub" style="color:rgba(255,255,255,.6)">Get it on</span>
                        <span class="store-name" style="color:#ffffff">Google Play</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
