<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاشتراكات - نظام ميري للاستقدام</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f8fafc 100%);
            min-height: 100vh;
            padding: 20px;
            direction: rtl;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(5, 79, 49, 0.05) 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .app-name {
            font-size: 36px;
            font-weight: 900;
            color: #054F31;
            margin-bottom: 10px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 30px;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }

        .current-subscription {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 40px;
        }

        .current-subscription h3 {
            font-size: 22px;
            font-weight: 700;
            color: #054F31;
            margin-bottom: 20px;
        }

        .subscription-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            padding: 16px;
            background: #f8fafc;
            border-radius: 10px;
        }

        .info-label {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }

        .plans-slider-wrapper {
            position: relative;
            margin-bottom: 50px;
            padding: 20px 0;
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        .swiper {
            width: 100%;
            padding: 20px 0 50px 0;
        }

        .swiper-slide {
            height: auto;
        }

        .swiper-pagination {
            bottom: 0 !important;
        }

        .swiper-pagination-bullet {
            background: #054F31;
            opacity: 0.3;
            width: 12px;
            height: 12px;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            background: #054F31;
            width: 30px;
            border-radius: 6px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #054F31;
            background: white;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #054F31;
            color: white;
            transform: scale(1.1);
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 18px;
            font-weight: 900;
        }

        .plan-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            padding: 32px 28px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border: 2px solid transparent;
            display: flex;
            flex-direction: column;
            min-height: 480px;
            height: 100%;
            overflow: hidden;
        }

        .plan-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #054F31 0%, #10b981 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .plan-card:hover::before {
            transform: scaleX(1);
        }

        .plan-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 24px 60px rgba(5, 79, 49, 0.25);
            border-color: rgba(5, 79, 49, 0.2);
        }

        .plan-card.current {
            border-color: #054F31;
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
            box-shadow: 0 15px 40px rgba(5, 79, 49, 0.25);
            animation: pulse-border 2s ease-in-out infinite;
        }

        .plan-card.current::before {
            transform: scaleX(1);
        }

        @keyframes pulse-border {
            0%, 100% {
                border-color: #054F31;
            }
            50% {
                border-color: #10b981;
            }
        }

        .plan-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #054F31 0%, #10b981 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(5, 79, 49, 0.3);
        }

        .plan-name {
            font-size: 24px;
            font-weight: 900;
            color: #054F31;
            margin-bottom: 10px;
            text-align: center;
            line-height: 1.3;
        }

        .plan-description {
            color: #64748b;
            margin-bottom: 24px;
            font-size: 14px;
            text-align: center;
            line-height: 1.5;
            min-height: 42px;
        }

        .plan-price-section {
            text-align: center;
            margin: 20px 0;
            padding: 20px 0;
            border-top: 2px solid #e2e8f0;
            border-bottom: 2px solid #e2e8f0;
        }

        .plan-price {
            font-size: 42px;
            font-weight: 900;
            color: #054F31;
            margin-bottom: 6px;
            line-height: 1;
        }

        .plan-currency {
            font-size: 16px;
            color: #64748b;
            font-weight: 600;
        }

        .plan-features {
            list-style: none;
            margin: 0 0 auto 0;
            flex-grow: 1;
            padding: 0;
            max-height: 200px;
            overflow-y: auto;
        }

        .plan-features::-webkit-scrollbar {
            width: 6px;
        }

        .plan-features::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .plan-features::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .plan-features::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .plan-features li {
            padding: 10px 0;
            color: #475569;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-align: right;
        }

        .plan-features li::before {
            content: '✓';
            color: #10b981;
            font-weight: 900;
            font-size: 20px;
            flex-shrink: 0;
        }

        .plan-card-footer {
            margin-top: auto;
            padding-top: 20px;
        }

        .btn {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Cairo', sans-serif;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #054F31 0%, #10b981 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #043a25 0%, #054F31 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(5, 79, 49, 0.3);
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #1e293b;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .subscriptions-table {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 30px;
            overflow-x: auto;
        }

        .subscriptions-table h3 {
            font-size: 22px;
            font-weight: 700;
            color: #054F31;
            margin-bottom: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            text-align: right;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #f8fafc;
            font-weight: 700;
            color: #1e293b;
            font-size: 14px;
        }

        td {
            color: #475569;
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-expired {
            background: #fef3c7;
            color: #92400e;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: .4s;
            border-radius: 26px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #054F31;
        }

        input:checked + .slider:before {
            transform: translateX(24px);
        }

        .coupon-section {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .coupon-input {
            display: flex;
            gap: 10px;
        }

        .coupon-input input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Cairo', sans-serif;
        }

        .coupon-input input:focus {
            outline: none;
            border-color: #054F31;
            box-shadow: 0 0 0 3px rgba(5, 79, 49, 0.1);
        }

        @media (max-width: 1024px) {
            .plans-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .plans-grid {
                grid-template-columns: 1fr;
            }

            .subscription-info {
                grid-template-columns: 1fr;
            }

            .plan-card {
                min-height: auto;
            }

            .swiper-button-next,
            .swiper-button-prev {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="app-name">نظام ميري للاستقدام</h1>
            <h2 class="page-title">الاشتراكات</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($currentSubscription)
            <div class="current-subscription">
                <h3>الاشتراك الحالي</h3>
                <div class="subscription-info">
                    <div class="info-item">
                        <div class="info-label">الخطة</div>
                        <div class="info-value">{{ $currentSubscription->plan->translations->where('lang_code', 'ar')->first()?->name ?? $currentSubscription->plan->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">تاريخ الانتهاء</div>
                        <div class="info-value">{{ $currentSubscription->ends_at->format('Y-m-d') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">السعر</div>
                        <div class="info-value">{{ number_format($currentSubscription->price, 2) }} {{ $currentSubscription->currency_code }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">الحالة</div>
                        <div class="info-value">
                            <span class="status-badge status-{{ $currentSubscription->status }}">{{ $currentSubscription->status === 'active' ? 'نشط' : ($currentSubscription->status === 'cancelled' ? 'ملغي' : 'منتهي') }}</span>
                        </div>
                    </div>
                </div>
                <form action="{{ route('office.subscriptions.toggle-auto-renew', $currentSubscription->id) }}" method="POST" style="display: inline-block; margin-left: 10px;">
                    @csrf
                    <label class="toggle-switch">
                        <input type="checkbox" {{ $currentSubscription->auto_renew ? 'checked' : '' }} onchange="this.form.submit()">
                        <span class="slider"></span>
                    </label>
                    <span style="margin-right: 10px; font-weight: 600;">التجديد التلقائي</span>
                </form>
                <form action="{{ route('office.subscriptions.cancel', $currentSubscription->id) }}" method="POST" style="display: inline-block; margin-right: 10px;">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من إلغاء الاشتراك؟')">إلغاء الاشتراك</button>
                </form>
            </div>
        @endif

        <div class="plans-slider-wrapper">
            <div class="swiper plans-slider">
                <div class="swiper-wrapper">
                    @foreach($plans->getCollection() as $plan)
                        @php
                            $priced = app(\App\Services\SubscriptionService::class)->priced($plan->code);
                            $planName = $plan->translations->where('lang_code', 'ar')->first()?->name ?? $plan->name;
                            $planDesc = $plan->translations->where('lang_code', 'ar')->first()?->description ?? $plan->description;
                            $isCurrent = $currentSubscription && $currentSubscription->plan_code === $plan->code;
                        @endphp
                        <div class="swiper-slide">
                            <div class="plan-card {{ $isCurrent ? 'current' : '' }}">
                                @if($isCurrent)
                                    <span class="plan-badge">الحالية</span>
                                @endif
                                <h3 class="plan-name">{{ $planName }}</h3>
                                <p class="plan-description">{{ $planDesc }}</p>
                                <div class="plan-price-section">
                                    <div class="plan-price">{{ number_format($priced['price'] ?? $plan->base_price, 2) }}</div>
                                    <div class="plan-currency">{{ $priced['currency'] ?? $plan->base_currency }} / {{ $plan->billing_cycle === 'monthly' ? 'شهري' : 'سنوي' }}</div>
                                </div>
                                <ul class="plan-features">
                                    @foreach($plan->features->where('active', true) as $feature)
                                        @php
                                            $translations = [
                                                'cv.limit' => 'عدد CV المسموح',
                                                'request.limit' => 'عدد الطلبات المسموح',
                                                'orders.limit' => 'عدد الطلبات المسموح',
                                                'office.users.limit' => 'عدد المستخدمين المسموح',
                                                'media.storage.gb' => 'مساحة التخزين (GB)',
                                                'support.priority' => 'دعم ذو أولوية',
                                                'cv.freeze.allowed' => 'تجميد CV مسموح',
                                                'exports.per_month' => 'عدد مرات التصدير شهرياً',
                                                'office.multi_branch' => 'دعم تعدد الفروع',
                                                'upload.allowed' => 'الرفع المسموح',
                                            ];
                                            $featureName = $translations[$feature->feature_key] ?? $feature->feature_key;
                                            $featureValue = $feature->limit ?? ($feature->value === 1 ? 'نعم' : ($feature->value ?? '-'));
                                        @endphp
                                        <li>{{ $featureName }}: {{ $featureValue }}</li>
                                    @endforeach
                                </ul>
                                <div class="plan-card-footer">
                                    @if(!$isCurrent)
                                        <form action="{{ route('office.subscriptions.subscribe') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="plan_code" value="{{ $plan->code }}">
                                            <button type="submit" class="btn btn-primary">اشترك الآن</button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary" disabled>مشترك حالياً</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        @if($subscriptions->count() > 0)
            <div class="subscriptions-table">
                <h3>سجل الاشتراكات</h3>
                <table>
                    <thead>
                        <tr>
                            <th>الخطة</th>
                            <th>الحالة</th>
                            <th>تاريخ البدء</th>
                            <th>تاريخ الانتهاء</th>
                            <th>السعر</th>
                            <th>التجديد التلقائي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscriptions as $sub)
                            <tr>
                                <td>{{ $sub->plan->translations->where('lang_code', 'ar')->first()?->name ?? $sub->plan->name }}</td>
                                <td>
                                    <span class="status-badge status-{{ $sub->status }}">
                                        {{ $sub->status === 'active' ? 'نشط' : ($sub->status === 'cancelled' ? 'ملغي' : ($sub->status === 'expired' ? 'منتهي' : 'معلق')) }}
                                    </span>
                                </td>
                                <td>{{ $sub->starts_at->format('Y-m-d') }}</td>
                                <td>{{ $sub->ends_at->format('Y-m-d') }}</td>
                                <td>{{ number_format($sub->price, 2) }} {{ $sub->currency_code }}</td>
                                <td>
                                    @if($sub->active)
                                        <form action="{{ route('office.subscriptions.toggle-auto-renew', $sub->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <label class="toggle-switch">
                                                <input type="checkbox" {{ $sub->auto_renew ? 'checked' : '' }} onchange="this.form.submit()">
                                                <span class="slider"></span>
                                            </label>
                                        </form>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 20px;">
                    {{ $subscriptions->links() }}
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.plans-slider', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: false,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 24,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 24,
                    },
                },
            });
        });
    </script>
</body>
</html>
