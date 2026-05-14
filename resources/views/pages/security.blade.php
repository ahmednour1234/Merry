@extends('layouts.site')

@section('title', 'الأمان - نظام ميري')

@section('styles')
<style>
    .security-section { padding: var(--page-section-padding) 0; }
    .security-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 4rem; }
    .security-card {
        background: var(--white); border: 1.5px solid var(--border);
        border-radius: var(--radius-lg); padding: 2rem 1.5rem; transition: all .3s;
    }
    .security-card:hover { border-color: var(--green-400); transform: translateY(-4px); box-shadow: var(--shadow-lg); }
    .security-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-bottom: 1rem; }
    .security-card h3 { font-size: 1rem; font-weight: 800; color: var(--text-dark); margin-bottom: .5rem; }
    .security-card p { font-size: .87rem; color: var(--text-light); line-height: 1.75; }
    .security-banner {
        background: linear-gradient(135deg, var(--green-800), var(--green-600));
        border-radius: var(--radius-xl); padding: 3rem; text-align: center;
        color: var(--white); margin-bottom: 4rem;
    }
    .security-banner h2 { font-size: 1.6rem; font-weight: 900; margin-bottom: 1rem; }
    .security-banner p { font-size: 1rem; color: rgba(255,255,255,.85); line-height: 2; max-width: 680px; margin: 0 auto; }
    .practices-list { max-width: 760px; margin: 0 auto; }
    .practice-item {
        display: flex; align-items: flex-start; gap: 1rem;
        padding: 1.25rem; border: 1.5px solid var(--border);
        border-radius: var(--radius-lg); margin-bottom: 1rem; transition: border-color .2s;
    }
    .practice-item:hover { border-color: var(--green-400); }
    .practice-num {
        width: 36px; height: 36px; background: var(--green-700); color: var(--white);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: .85rem; font-weight: 900; flex-shrink: 0;
    }
    .practice-item h4 { font-size: .95rem; font-weight: 700; color: var(--text-dark); margin-bottom: .25rem; }
    .practice-item p { font-size: .87rem; color: var(--text-light); line-height: 1.65; }
    @media (max-width: 768px) {
        .security-grid { grid-template-columns: 1fr 1fr; }
        .security-banner { padding: 2rem 1.25rem; }
    }
    @media (max-width: 480px) {
        .security-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <div class="page-header-tag">🛡️ الأمان</div>
        <h1>أمانك أولويتنا القصوى</h1>
        <p>نعتمد أحدث تقنيات الأمان لحماية بياناتك وضمان سلامة معاملاتك</p>
    </div>
</div>

<section class="security-section">
    <div class="container">

        <div class="security-grid">
            <div class="security-card">
                <div class="security-icon" style="background:#dcfce7">🔐</div>
                <h3>تشفير البيانات</h3>
                <p>جميع البيانات مشفرة بتقنية SSL/TLS 256-bit أثناء النقل والتخزين لضمان سريتها التامة</p>
            </div>
            <div class="security-card">
                <div class="security-icon" style="background:#dbeafe">🔑</div>
                <h3>مصادقة قوية</h3>
                <p>نظام تحقق ثنائي العوامل وكلمات مرور مشفرة تضمن أن حسابك لا يصل إليه سوى أنت</p>
            </div>
            <div class="security-card">
                <div class="security-icon" style="background:#fef3c7">👁️</div>
                <h3>مراقبة مستمرة</h3>
                <p>أنظمة مراقبة تعمل 24/7 لرصد أي نشاط مشبوه والتصدي له فوراً</p>
            </div>
            <div class="security-card">
                <div class="security-icon" style="background:#fce7f3">🛡️</div>
                <h3>جدار حماية متقدم</h3>
                <p>حماية متعددة الطبقات ضد هجمات DDoS وحقن SQL وغيرها من التهديدات السيبرانية</p>
            </div>
            <div class="security-card">
                <div class="security-icon" style="background:#ede9fe">💾</div>
                <h3>نسخ احتياطية آمنة</h3>
                <p>نسخ احتياطية تلقائية يومية مخزنة في خوادم منفصلة لضمان استمرارية الخدمة</p>
            </div>
            <div class="security-card">
                <div class="security-icon" style="background:#f0fdf4">📋</div>
                <h3>سجلات التدقيق</h3>
                <p>تسجيل شامل لجميع العمليات يتيح التتبع الكامل وضمان المساءلة</p>
            </div>
        </div>

        <div class="security-banner">
            <h2>🛡️ التزامنا بالأمان</h2>
            <p>نظام ميري يلتزم بأعلى معايير الأمان المعلوماتي المعتمدة دولياً.
            نجري اختبارات اختراق دورية ونتعاون مع خبراء أمن المعلومات لضمان
            حماية قصوى لبيانات جميع مستخدمينا في كل وقت.</p>
        </div>

        <div class="practices-list">
            <h2 style="text-align:center;font-size:1.5rem;font-weight:900;color:var(--text-dark);margin-bottom:2rem;">أفضل الممارسات الأمنية</h2>
            <div class="practice-item">
                <div class="practice-num">1</div>
                <div>
                    <h4>استخدم كلمة مرور قوية وفريدة</h4>
                    <p>استخدم كلمة مرور تتكون من أحرف كبيرة وصغيرة وأرقام ورموز خاصة ولا تقل عن 8 أحرف</p>
                </div>
            </div>
            <div class="practice-item">
                <div class="practice-num">2</div>
                <div>
                    <h4>فعّل المصادقة الثنائية</h4>
                    <p>أضف طبقة حماية إضافية لحسابك من خلال تفعيل التحقق بخطوتين</p>
                </div>
            </div>
            <div class="practice-item">
                <div class="practice-num">3</div>
                <div>
                    <h4>لا تشارك بيانات دخولك</h4>
                    <p>احتفظ ببيانات حسابك لنفسك ولا تشاركها مع أي شخص، بما في ذلك فريق الدعم</p>
                </div>
            </div>
            <div class="practice-item">
                <div class="practice-num">4</div>
                <div>
                    <h4>راجع سجل النشاط بانتظام</h4>
                    <p>تتبع نشاط حسابك وأبلغنا فوراً عن أي عملية غير مألوفة أو مشبوهة</p>
                </div>
            </div>
            <div class="practice-item">
                <div class="practice-num">5</div>
                <div>
                    <h4>تحديث بياناتك أولاً بأول</h4>
                    <p>حافظ على تحديث بريدك الإلكتروني ورقم هاتفك لضمان تلقيك لإشعارات الأمان</p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
