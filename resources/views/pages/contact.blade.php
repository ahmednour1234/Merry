@extends('layouts.site')

@section('title', 'تواصل معنا - نظام ميري')

@section('styles')
<style>
    .contact-section { padding: var(--page-section-padding) 0; }
    .contact-grid { display: grid; grid-template-columns: 1fr 1.6fr; gap: 3rem; align-items: flex-start; }

    /* Info cards */
    .contact-info { display: flex; flex-direction: column; gap: 1.25rem; }
    .contact-info-card {
        background: var(--green-50); border: 1.5px solid var(--green-100);
        border-radius: var(--radius-lg); padding: 1.25rem;
        display: flex; align-items: flex-start; gap: 1rem;
    }
    .contact-info-icon {
        width: 48px; height: 48px; background: var(--green-700);
        border-radius: 12px; display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; flex-shrink: 0; color: var(--white);
    }
    .contact-info-body h3 { font-size: .95rem; font-weight: 700; color: var(--text-dark); margin-bottom: .25rem; }
    .contact-info-body p { font-size: .87rem; color: var(--text-mid); line-height: 1.6; }
    .contact-info-body .contact-phone { direction: ltr; unicode-bidi: isolate; display: inline-block; }

    /* Form */
    .contact-form-wrap {
        background: var(--white); border: 1.5px solid var(--border);
        border-radius: var(--radius-xl); padding: 2rem;
        box-shadow: 0 4px 24px rgba(5,79,49,.07);
    }
    .contact-form-wrap h2 { font-size: 1.4rem; font-weight: 800; color: var(--text-dark); margin-bottom: .4rem; }
    .contact-form-wrap p { font-size: .9rem; color: var(--text-light); margin-bottom: 1.75rem; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .form-group { display: flex; flex-direction: column; gap: .4rem; margin-bottom: 1rem; }
    .form-group label { font-size: .87rem; font-weight: 700; color: var(--text-mid); }
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%; padding: .65rem 1rem; border: 1.5px solid var(--border);
        border-radius: 10px; font-size: .9rem; font-family: 'Tajawal', sans-serif;
        color: var(--text-dark); background: var(--white); transition: border-color .2s;
        outline: none;
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus { border-color: var(--green-600); box-shadow: 0 0 0 3px rgba(22,163,74,.1); }
    .form-group textarea { resize: vertical; min-height: 130px; }
    .form-group .error { font-size: .8rem; color: #ef4444; margin-top: .15rem; }
    .btn-submit {
        width: 100%; padding: .85rem; background: var(--green-700);
        color: var(--white); border: none; border-radius: 50px;
        font-size: 1rem; font-weight: 700; font-family: 'Tajawal', sans-serif;
        cursor: pointer; transition: all .25s; margin-top: .5rem;
    }
    .btn-submit:hover { background: var(--green-800); transform: translateY(-2px); box-shadow: var(--shadow-lg); }

    .alert-success {
        background: #dcfce7; border: 1.5px solid #86efac; color: #166534;
        padding: 1rem 1.25rem; border-radius: 10px; font-weight: 600;
        margin-bottom: 1.5rem; font-size: .92rem;
    }

    @media (max-width: 768px) {
        .contact-section { padding: var(--page-section-padding-mobile) 0; }
        .contact-grid { grid-template-columns: 1fr; gap: 1.75rem; }
        .contact-form-wrap { order: -1; padding: 1.35rem; }
        .form-row { grid-template-columns: 1fr; }
        .contact-info { flex-direction: row; flex-wrap: wrap; gap: 1rem; }
        .contact-info-card { flex: 1 1 calc(50% - .5rem); }
    }
    @media (max-width: 480px) {
        .contact-info-card { flex: 1 1 100%; }
        .contact-form-wrap { padding: 1.1rem .95rem; }
        .contact-form-wrap h2 { font-size: 1.2rem; }
        .btn-submit { font-size: .95rem; padding: .75rem; }
    }
</style>
@endsection

@section('content')
<!-- PAGE HEADER -->
<div class="page-header">
    <div class="container">
        <div class="page-header-tag">📬 تواصل معنا</div>
        <h1>نحن هنا للمساعدة</h1>
        <p>لديك استفسار أو اقتراح؟ فريقنا جاهز للرد عليك في أقرب وقت ممكن</p>
    </div>
</div>

<!-- CONTACT SECTION -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">

            <!-- Info -->
            <div class="contact-info">
                <div class="contact-info-card">
                    <div class="contact-info-icon">📞</div>
                    <div class="contact-info-body">
                        <h3>الهاتف</h3>
                        <p><span class="contact-phone">+966 57 938 1480</span><br>متاح من 8 صباحاً - 10 مساءً</p>
                    </div>
                </div>
                <div class="contact-info-card">
                    <div class="contact-info-icon">✉️</div>
                    <div class="contact-info-body">
                        <h3>البريد الإلكتروني</h3>
                        <p>info@mery.sa<br>نرد خلال 24 ساعة</p>
                    </div>
                </div>
                <div class="contact-info-card">
                    <div class="contact-info-icon">📍</div>
                    <div class="contact-info-body">
                        <h3>الموقع</h3>
                        <p>الرياض - المملكة العربية السعودية</p>
                    </div>
                </div>
                <div class="contact-info-card">
                    <div class="contact-info-icon">🕐</div>
                    <div class="contact-info-body">
                        <h3>ساعات العمل</h3>
                        <p>الأحد - الخميس<br>8:00 صباحاً - 5:00 مساءً</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="contact-form-wrap">
                <h2>أرسل لنا رسالة</h2>
                <p>سنتواصل معك في أقرب وقت ممكن</p>

                @if(session('success'))
                    <div class="alert-success">✅ {{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">الاسم الكامل <span style="color:#ef4444">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="أدخل اسمك الكامل" required>
                            @error('name') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني <span style="color:#ef4444">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="example@email.com" required>
                            @error('email') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">رقم الهاتف</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="05xxxxxxxx">
                            @error('phone') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="subject">الموضوع <span style="color:#ef4444">*</span></label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="موضوع رسالتك" required>
                            @error('subject') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">الرسالة <span style="color:#ef4444">*</span></label>
                        <textarea id="message" name="message" placeholder="اكتب رسالتك هنا..." required>{{ old('message') }}</textarea>
                        @error('message') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn-submit">إرسال الرسالة ✉️</button>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
