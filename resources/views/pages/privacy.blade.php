@extends('layouts.site')

@section('title', 'سياسة الخصوصية - نظام ميري')

@section('styles')
<style>
    .policy-section { padding: 80px 0; }
    .policy-wrap { max-width: 860px; margin: 0 auto; }
    .policy-updated { font-size: .85rem; color: var(--text-light); margin-bottom: 2rem; }
    .policy-block { margin-bottom: 2.5rem; }
    .policy-block h2 {
        font-size: 1.15rem; font-weight: 800; color: var(--green-800);
        margin-bottom: .85rem; padding-bottom: .5rem;
        border-bottom: 2px solid var(--green-100);
    }
    .policy-block p, .policy-block li { font-size: .95rem; color: var(--text-mid); line-height: 2; }
    .policy-block ul { padding-right: 1.5rem; display: flex; flex-direction: column; gap: .4rem; }
    .policy-block li::marker { color: var(--green-600); }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <div class="page-header-tag">🔒 الخصوصية</div>
        <h1>سياسة الخصوصية</h1>
        <p>نلتزم بحماية بياناتك الشخصية واحترام خصوصيتك في جميع الأوقات</p>
    </div>
</div>

<section class="policy-section">
    <div class="container">
        <div class="policy-wrap">
            <p class="policy-updated">آخر تحديث: مايو 2026</p>

            <div class="policy-block">
                <h2>1. المعلومات التي نجمعها</h2>
                <p>نقوم بجمع المعلومات التي تقدمها لنا مباشرةً عند إنشاء حسابك أو استخدام خدماتنا، وتشمل:</p>
                <ul>
                    <li>الاسم الكامل وبيانات التواصل (البريد الإلكتروني، رقم الهاتف)</li>
                    <li>معلومات المكتب أو المنشأة عند التسجيل</li>
                    <li>البيانات المرتبطة بالطلبات والمعاملات المُجراة عبر المنصة</li>
                    <li>بيانات الاستخدام وسجلات النشاط على المنصة</li>
                </ul>
            </div>

            <div class="policy-block">
                <h2>2. كيفية استخدام المعلومات</h2>
                <p>نستخدم المعلومات المجموعة للأغراض التالية:</p>
                <ul>
                    <li>تقديم خدماتنا وتشغيل المنصة بكفاءة</li>
                    <li>التواصل معك بشأن حسابك وطلباتك</li>
                    <li>تحسين خدماتنا وتجربة المستخدم</li>
                    <li>الامتثال للمتطلبات القانونية والتنظيمية</li>
                    <li>إرسال تحديثات وإشعارات تتعلق بالخدمة</li>
                </ul>
            </div>

            <div class="policy-block">
                <h2>3. حماية المعلومات</h2>
                <p>نطبق أعلى معايير الأمان لحماية بياناتك، بما في ذلك:</p>
                <ul>
                    <li>تشفير البيانات أثناء النقل والتخزين باستخدام بروتوكول SSL/TLS</li>
                    <li>التحكم الصارم في الوصول إلى البيانات الحساسة</li>
                    <li>إجراء اختبارات أمنية دورية على الأنظمة</li>
                    <li>تدريب الفريق على أفضل ممارسات حماية البيانات</li>
                </ul>
            </div>

            <div class="policy-block">
                <h2>4. مشاركة المعلومات</h2>
                <p>لا نبيع بياناتك الشخصية لأطراف ثالثة. قد نشارك المعلومات في الحالات التالية:</p>
                <ul>
                    <li>عند الحصول على موافقتك الصريحة</li>
                    <li>للامتثال للمتطلبات القانونية والقضائية</li>
                    <li>مع مزودي الخدمات الموثوقين الذين يساعدوننا في تشغيل المنصة</li>
                </ul>
            </div>

            <div class="policy-block">
                <h2>5. حقوقك</h2>
                <p>لديك الحق في:</p>
                <ul>
                    <li>الاطلاع على البيانات الشخصية التي نحتفظ بها عنك</li>
                    <li>طلب تصحيح أي بيانات غير دقيقة</li>
                    <li>طلب حذف بياناتك وفق الإجراءات المتاحة</li>
                    <li>إلغاء الاشتراك في الرسائل التسويقية في أي وقت</li>
                </ul>
            </div>

            <div class="policy-block">
                <h2>6. التواصل</h2>
                <p>إذا كانت لديك أي أسئلة حول سياسة الخصوصية، يمكنك التواصل معنا عبر:
                البريد الإلكتروني: <strong>privacy@mery.sa</strong> أو من خلال
                <a href="{{ route('contact') }}" style="color:var(--green-700)">صفحة تواصل معنا</a>.</p>
            </div>
        </div>
    </div>
</section>
@endsection
