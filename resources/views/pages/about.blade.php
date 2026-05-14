@extends('layouts.site')

@section('title', 'عن التطبيق - نظام ميري')

@section('styles')
<style>
    .about-section { padding: 80px 0; }
    .about-lead { font-size: 1.05rem; color: var(--text-mid); line-height: 2; max-width: 760px; margin: 0 auto 3rem; text-align: center; }
    .values-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 4rem; }
    .value-card {
        background: var(--white); border: 1.5px solid var(--border);
        border-radius: var(--radius-lg); padding: 2rem 1.5rem; text-align: center; transition: all .3s;
    }
    .value-card:hover { border-color: var(--green-400); transform: translateY(-4px); box-shadow: var(--shadow-lg); }
    .value-icon { width: 64px; height: 64px; background: var(--green-50); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 1rem; }
    .value-card h3 { font-size: 1.05rem; font-weight: 800; color: var(--text-dark); margin-bottom: .5rem; }
    .value-card p { font-size: .88rem; color: var(--text-light); line-height: 1.75; }
    .mission-wrap {
        background: var(--green-800); border-radius: var(--radius-xl);
        padding: 3rem; text-align: center; color: var(--white);
        margin-bottom: 4rem;
    }
    .mission-wrap h2 { font-size: 1.6rem; font-weight: 900; margin-bottom: 1rem; }
    .mission-wrap p { font-size: 1rem; color: rgba(255,255,255,.8); line-height: 2; max-width: 680px; margin: 0 auto; }
    .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    .stat-card {
        background: var(--green-50); border: 1.5px solid var(--green-100);
        border-radius: var(--radius-lg); padding: 1.75rem; text-align: center;
    }
    .stat-card .num { font-size: 2rem; font-weight: 900; color: var(--green-800); display: block; }
    .stat-card .lbl { font-size: .85rem; color: var(--text-light); margin-top: .3rem; display: block; }
    @media (max-width: 768px) {
        .values-grid { grid-template-columns: 1fr 1fr; }
        .stats-row { grid-template-columns: 1fr 1fr; }
        .mission-wrap { padding: 2rem 1.25rem; }
    }
    @media (max-width: 480px) {
        .values-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <div class="page-header-tag">✨ عن نظام ميري</div>
        <h1>منصة متكاملة لخدمات الاستقدام</h1>
        <p>نربط مكاتب الاستقدام بالمستخدمين في منظومة رقمية واحدة احترافية وآمنة</p>
    </div>
</div>

<section class="about-section">
    <div class="container">
        <p class="about-lead">
            نظام ميري هو منصة تقنية متطورة تم تصميمها خصيصاً لقطاع الاستقدام في المملكة العربية السعودية.
            هدفنا تبسيط الإجراءات وتوفير تجربة رقمية متكاملة تُمكّن مكاتب الاستقدام والمستخدمين من إدارة
            جميع عملياتهم بسهولة وكفاءة عالية في مكان واحد.
        </p>

        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">🎯</div>
                <h3>دقة وكفاءة</h3>
                <p>نضمن معالجة الطلبات بدقة عالية مع تقليل الأخطاء البشرية وتوفير الوقت والجهد</p>
            </div>
            <div class="value-card">
                <div class="value-icon">🔒</div>
                <h3>أمان وموثوقية</h3>
                <p>بيانات مشفرة وحماية قصوى لجميع معلومات المستخدمين والمكاتب في كل وقت</p>
            </div>
            <div class="value-card">
                <div class="value-icon">🚀</div>
                <h3>سرعة وسهولة</h3>
                <p>واجهة بسيطة وسهلة الاستخدام تتيح لك إنجاز المعاملات في دقائق</p>
            </div>
            <div class="value-card">
                <div class="value-icon">📊</div>
                <h3>تقارير ذكية</h3>
                <p>تحليلات وإحصاءات متقدمة تساعدك على اتخاذ قرارات مبنية على البيانات</p>
            </div>
            <div class="value-card">
                <div class="value-icon">🔔</div>
                <h3>إشعارات فورية</h3>
                <p>ابق على اطلاع دائم بكل مستجدات طلباتك وعملياتك في الوقت الفعلي</p>
            </div>
            <div class="value-card">
                <div class="value-icon">🤝</div>
                <h3>دعم متواصل</h3>
                <p>فريق دعم متخصص جاهز لمساعدتك على مدار الساعة طوال أيام الأسبوع</p>
            </div>
        </div>

        <div class="mission-wrap">
            <h2>رسالتنا</h2>
            <p>نسعى إلى تحويل قطاع الاستقدام نحو بيئة رقمية متطورة تُعزز الشفافية والكفاءة
            وتُوفر تجربة مستخدم استثنائية لكل من مكاتب الاستقدام والمستخدمين،
            مع الالتزام بأعلى معايير الأمان وحماية البيانات.</p>
        </div>

        <div class="stats-row">
            <div class="stat-card"><span class="num">+500</span><span class="lbl">مكتب استقدام</span></div>
            <div class="stat-card"><span class="num">+10K</span><span class="lbl">سيرة ذاتية</span></div>
            <div class="stat-card"><span class="num">99%</span><span class="lbl">رضا العملاء</span></div>
            <div class="stat-card"><span class="num">24/7</span><span class="lbl">دعم فني مستمر</span></div>
        </div>
    </div>
</section>
@endsection
