@extends('layouts.site')

@section('title', 'الشروط والأحكام - نظام ميري')

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
        <div class="page-header-tag">📋 الشروط والأحكام</div>
        <h1>شروط استخدام نظام ميري</h1>
        <p>يرجى قراءة هذه الشروط بعناية قبل استخدام منصتنا</p>
    </div>
</div>

<section class="policy-section">
    <div class="container">
        <div class="policy-wrap">
            <p class="policy-updated">آخر تحديث: مايو 2026</p>

            <div class="policy-block">
                <h2>1. القبول بالشروط</h2>
                <p>باستخدامك لنظام ميري، فإنك توافق على الالتزام بهذه الشروط والأحكام. إذا كنت لا توافق على أي من هذه الشروط، يرجى عدم استخدام المنصة.</p>
            </div>

            <div class="policy-block">
                <h2>2. وصف الخدمة</h2>
                <p>نظام ميري هو منصة رقمية تتيح لمكاتب الاستقدام وللمستخدمين إدارة عمليات الاستقدام إلكترونياً، وتشمل الخدمات:</p>
                <ul>
                    <li>تقديم ومتابعة طلبات الاستقدام</li>
                    <li>إدارة السير الذاتية والمرشحين</li>
                    <li>التواصل بين المكاتب والمستخدمين</li>
                    <li>إصدار التقارير والإحصاءات</li>
                </ul>
            </div>

            <div class="policy-block">
                <h2>3. شروط التسجيل</h2>
                <p>عند التسجيل في المنصة، يجب عليك:</p>
                <ul>
                    <li>تقديم معلومات دقيقة وصحيحة وكاملة</li>
                    <li>الحفاظ على سرية بيانات دخولك وعدم مشاركتها</li>
                    <li>إخطارنا فوراً في حال الاشتباه بأي وصول غير مصرح به لحسابك</li>
                    <li>تحديث بياناتك بصفة منتظمة للحفاظ على دقتها</li>
                </ul>
            </div>

            <div class="policy-block">
                <h2>4. الاستخدام المقبول</h2>
                <p>يُحظر استخدام المنصة لأي من الأغراض التالية:</p>
                <ul>
                    <li>نشر معلومات مضللة أو كاذبة</li>
                    <li>انتهاك حقوق الآخرين أو الإضرار بهم</li>
                    <li>محاولة اختراق أو التلاعب بأنظمة المنصة</li>
                    <li>إرسال محتوى مسيء أو غير لائق</li>
                    <li>أي نشاط يخالف الأنظمة والقوانين المعمول بها في المملكة العربية السعودية</li>
                </ul>
            </div>

            <div class="policy-block">
                <h2>5. الملكية الفكرية</h2>
                <p>جميع محتويات المنصة من تصاميم وبرمجيات وعلامات تجارية هي ملك حصري لنظام ميري ومحمية بموجب قوانين الملكية الفكرية. لا يجوز نسخ أو توزيع أو استخدام هذه المحتويات دون إذن كتابي مسبق.</p>
            </div>

            <div class="policy-block">
                <h2>6. إخلاء المسؤولية</h2>
                <p>تُقدَّم الخدمات "كما هي" دون ضمانات من أي نوع. لا نتحمل المسؤولية عن أي أضرار مباشرة أو غير مباشرة ناجمة عن استخدام المنصة أو عدم القدرة على استخدامها.</p>
            </div>

            <div class="policy-block">
                <h2>7. التعديلات على الشروط</h2>
                <p>نحتفظ بالحق في تعديل هذه الشروط في أي وقت. سيُخطَر المستخدمون بأي تغييرات جوهرية عبر البريد الإلكتروني أو من خلال إشعار على المنصة. استمرار استخدامك للمنصة بعد إجراء التعديلات يعني قبولك للشروط المحدّثة.</p>
            </div>

            <div class="policy-block">
                <h2>8. القانون المطبق</h2>
                <p>تخضع هذه الشروط لأنظمة المملكة العربية السعودية وتُفسَّر وفقاً لها. أي نزاع يُحال إلى المحاكم المختصة في المملكة العربية السعودية.</p>
            </div>
        </div>
    </div>
</section>
@endsection
