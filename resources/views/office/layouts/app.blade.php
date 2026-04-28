<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'نظام ميري') - نظام ميري</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        *{font-family:'Cairo',sans-serif!important;box-sizing:border-box}
        html,body{height:100%;overflow:hidden;margin:0;padding:0;background:#f4f6f9}
        /* NAV */
        .nav-link{display:flex;align-items:center;gap:.65rem;padding:.6rem 1rem;color:#4b5563;text-decoration:none;font-size:.875rem;font-weight:500;transition:all .15s ease;border-radius:10px;margin:2px 10px}
        .nav-link svg{width:18px;height:18px;flex-shrink:0;color:#6b7280;transition:color .15s}
        .nav-link:hover{background:#f0fdf4;color:#054F31}
        .nav-link:hover svg{color:#054F31}
        .nav-link.active{background:#e8f5e9;color:#054F31;font-weight:700}
        .nav-link.active svg{color:#054F31}
        /* SCROLLBAR */
        ::-webkit-scrollbar{width:4px}
        ::-webkit-scrollbar-track{background:transparent}
        ::-webkit-scrollbar-thumb{background:#d1d5db;border-radius:4px}
        /* COMPONENTS */
        .stat-card{background:#fff;border-radius:14px;padding:1.1rem 1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.06)}
        .data-table{width:100%;border-collapse:collapse}
        .data-table th{background:#f9fafb;font-size:.78rem;font-weight:600;color:#6b7280;padding:.7rem 1rem;text-align:right}
        .data-table td{padding:.8rem 1rem;border-bottom:1px solid #f3f4f6;font-size:.875rem;color:#374151}
        .data-table tr:last-child td{border-bottom:none}
        .data-table tr:hover td{background:#fafafa}
        .badge{display:inline-flex;align-items:center;padding:.18rem .65rem;border-radius:9999px;font-size:.75rem;font-weight:600}
        .badge-success{background:#d1fae5;color:#065f46}
        .badge-warning{background:#fef3c7;color:#92400e}
        .badge-danger{background:#fee2e2;color:#991b1b}
        .badge-gray{background:#f3f4f6;color:#374151}
        .badge-blue{background:#dbeafe;color:#1e40af}
        .badge-new{background:#ecfdf5;color:#059669;border:1px solid #6ee7b7}
        .alert{padding:.85rem 1.2rem;border-radius:10px;margin-bottom:1rem;font-size:.875rem}
        .alert-success{background:#d1fae5;color:#065f46;border:1px solid #a7f3d0}
        .alert-error{background:#fee2e2;color:#991b1b;border:1px solid #fca5a5}
        .alert-warning{background:#fef3c7;color:#92400e;border:1px solid #fde68a}
        .btn-primary{background:#054F31;color:#fff;border:none;border-radius:8px;padding:.55rem 1.2rem;cursor:pointer;font-size:.875rem;font-weight:600;transition:background .15s;display:inline-block;text-decoration:none}
        .btn-primary:hover{background:#043d26}
        .btn-secondary{background:#f3f4f6;color:#374151;border:1px solid #e5e7eb;border-radius:8px;padding:.55rem 1.2rem;cursor:pointer;font-size:.875rem;font-weight:500;transition:all .15s;display:inline-block;text-decoration:none}
        .btn-secondary:hover{background:#e5e7eb}
        .btn-danger{background:#ef4444;color:#fff;border:none;border-radius:8px;padding:.55rem 1.2rem;cursor:pointer;font-size:.875rem;font-weight:600}
        .form-input{width:100%;border:1px solid #d1d5db;border-radius:8px;padding:.55rem .875rem;font-size:.875rem;color:#111827;outline:none;transition:border-color .15s}
        .form-input:focus{border-color:#054F31;box-shadow:0 0 0 3px rgba(5,79,49,.08)}
        .form-label{display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.35rem}
        .form-error{color:#dc2626;font-size:.78rem;margin-top:.25rem}
        .pagination-wrap{display:flex;gap:.35rem;align-items:center}
        .pagination-wrap a,.pagination-wrap span{padding:.3rem .7rem;border-radius:6px;font-size:.82rem;border:1px solid #e5e7eb;color:#374151;text-decoration:none}
        .pagination-wrap a:hover{background:#f3f4f6}
        .pagination-wrap .active-page{background:#054F31;color:#fff;border-color:#054F31}
        /* MOBILE */
        @media(max-width:767px){
            #sidebar{position:fixed;right:0;top:0;bottom:0;z-index:150;transform:translateX(110%);transition:transform .28s ease}
            #sidebar.open{transform:translateX(0)}
        }
    </style>
    @stack('styles')
</head>
<body>
<div id="overlay" onclick="closeSidebar()" style="display:none;position:fixed;inset:0;z-index:130;background:rgba(0,0,0,.45)"></div>

@php
    $__office = auth()->guard('office-panel')->user();
    try{
        $__sub=\App\Models\OfficeSubscription::on('system')->where('office_id',$__office?->id)->where('status','active')->with('plan')->orderByDesc('created_at')->first();
        $__planName=$__sub?->plan?->name??'مجانية';
        $__planExpiry=$__sub?->ends_at?->format('Y-m-d');
        $__daysLeft=$__sub?->ends_at?->diffInDays(now(),false)*-1;
    }catch(\Exception $e){$__planName='مجانية';$__planExpiry=null;$__daysLeft=null;}
    try{
        $__phone=\App\Models\SystemSetting::where('key','support_phone')->value('value')??'+966 50 123 4567';
        $__supportEmail=\App\Models\SystemSetting::where('key','support_email')->value('value')??'support@merry.com';
    }catch(\Exception $e){$__phone='+966 50 123 4567';$__supportEmail='support@merry.com';}
@endphp

<div style="display:flex;height:100vh;overflow:hidden;">

    {{-- ══════════════════════════════════════════
         SIDEBAR
    ══════════════════════════════════════════ --}}
    <aside id="sidebar" style="width:260px;flex-shrink:0;display:flex;flex-direction:column;height:100vh;background:#fff;border-left:1px solid #e8ecf0;overflow-y:auto;overflow-x:hidden;">

        {{-- Office Header --}}
        <div style="background:linear-gradient(135deg,#054F31,#0a6b42);padding:1.25rem;display:flex;align-items:center;gap:.875rem;">
            <div style="width:46px;height:46px;border-radius:14px;background:rgba(255,255,255,.18);display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden;" id="sb-avatar">
                @if($__office?->image)
                    <img src="{{ $__office->image_url }}" style="width:46px;height:46px;object-fit:cover;" alt=""
                         onerror="this.style.display='none';document.getElementById('sb-avatar-fallback').style.display='flex'">
                    <span id="sb-avatar-fallback" style="display:none;width:100%;height:100%;align-items:center;justify-content:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                    </span>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                @endif
            </div>
            <div style="overflow:hidden;flex:1;">
                <div style="font-weight:800;font-size:.9rem;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $__office?->name }}</div>
                <div style="font-size:.7rem;color:rgba(255,255,255,.55);margin-top:.1rem;">لوحة التحكم</div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav style="padding:.75rem .75rem .5rem;">

            {{-- Section label --}}
            <div style="font-size:.68rem;font-weight:800;color:#9ca3af;letter-spacing:.06em;padding:.1rem .5rem .6rem;text-transform:uppercase;">القائمة الرئيسية</div>

            <a href="{{ route('office.dashboard') }}" class="nav-link {{ request()->routeIs('office.dashboard*')?'active':'' }}">
                <div style="width:32px;height:32px;border-radius:9px;background:{{ request()->routeIs('office.dashboard*') ? 'linear-gradient(135deg,#054F31,#0a6b42)' : '#f3f4f6' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .15s;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ request()->routeIs('office.dashboard*') ? 'white' : '#6b7280' }}" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                </div>
                الرئيسية
            </a>

            <a href="{{ route('office.cvs.index') }}" class="nav-link {{ (request()->routeIs('office.cvs*')&&!request()->routeIs('office.cvs.create'))?'active':'' }}">
                <div style="width:32px;height:32px;border-radius:9px;background:{{ (request()->routeIs('office.cvs*')&&!request()->routeIs('office.cvs.create')) ? 'linear-gradient(135deg,#054F31,#0a6b42)' : '#f3f4f6' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .15s;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ (request()->routeIs('office.cvs*')&&!request()->routeIs('office.cvs.create')) ? 'white' : '#6b7280' }}" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                </div>
                السير الذاتية
            </a>

            <a href="{{ route('office.cvs.create') }}" class="nav-link {{ request()->routeIs('office.cvs.create')?'active':'' }}" style="padding-right:1.6rem!important;">
                <div style="width:24px;height:24px;border-radius:7px;background:{{ request()->routeIs('office.cvs.create') ? 'linear-gradient(135deg,#054F31,#0a6b42)' : '#f0fdf4' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .15s;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="{{ request()->routeIs('office.cvs.create') ? 'white' : '#054F31' }}" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                </div>
                <span style="font-size:.82rem;color:{{ request()->routeIs('office.cvs.create') ? '#054F31' : '#6b7280' }};">إضافة سيرة ذاتية</span>
            </a>

            <a href="{{ route('office.bookings.index') }}" class="nav-link {{ request()->routeIs('office.bookings*')?'active':'' }}">
                <div style="width:32px;height:32px;border-radius:9px;background:{{ request()->routeIs('office.bookings*') ? 'linear-gradient(135deg,#054F31,#0a6b42)' : '#f3f4f6' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .15s;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ request()->routeIs('office.bookings*') ? 'white' : '#6b7280' }}" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>
                </div>
                الحجوزات
            </a>

            <a href="{{ route('office.subscriptions.index') }}" class="nav-link {{ request()->routeIs('office.subscriptions*')?'active':'' }}">
                <div style="width:32px;height:32px;border-radius:9px;background:{{ request()->routeIs('office.subscriptions*') ? 'linear-gradient(135deg,#054F31,#0a6b42)' : '#f3f4f6' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .15s;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ request()->routeIs('office.subscriptions*') ? 'white' : '#6b7280' }}" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/></svg>
                </div>
                الاشتراكات
            </a>

            <a href="{{ route('office.reports.index') }}" class="nav-link {{ request()->routeIs('office.reports*')?'active':'' }}">
                <div style="width:32px;height:32px;border-radius:9px;background:{{ request()->routeIs('office.reports*') ? 'linear-gradient(135deg,#054F31,#0a6b42)' : '#f3f4f6' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .15s;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ request()->routeIs('office.reports*') ? 'white' : '#6b7280' }}" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                </div>
                التقارير
            </a>

        </nav>

        {{-- Subscription + Support --}}
        <div style="padding:.75rem .875rem 1.25rem;">

            {{-- Subscription card --}}
            <div style="background:linear-gradient(135deg,#054F31 0%,#0a6b42 100%);border-radius:16px;padding:1rem 1.1rem;margin-bottom:.75rem;position:relative;overflow:hidden;">
                <div style="position:absolute;top:-25px;left:-25px;width:90px;height:90px;border-radius:50%;background:rgba(255,255,255,.06);pointer-events:none;"></div>
                <div style="position:absolute;bottom:-15px;right:-15px;width:60px;height:60px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none;"></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.5rem;position:relative;">
                    <div style="display:flex;align-items:center;gap:.4rem;">
                        <div style="width:26px;height:26px;border-radius:8px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#fbbf24" viewBox="0 0 24 24" style="width:14px;height:14px;"><path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                        </div>
                        <span style="font-size:.68rem;color:rgba(255,255,255,.6);font-weight:600;">الباقة الحالية</span>
                    </div>
                    @if($__daysLeft !== null && $__daysLeft <= 10)
                        <span style="background:rgba(239,68,68,.3);color:#fca5a5;font-size:.62rem;font-weight:700;padding:.15rem .5rem;border-radius:99px;border:1px solid rgba(239,68,68,.3);">{{ $__daysLeft }} أيام</span>
                    @endif
                </div>
                <div style="font-size:1rem;font-weight:800;color:#fbbf24;margin-bottom:.2rem;position:relative;">{{ $__planName }}</div>
                @if($__planExpiry)
                    <div style="font-size:.68rem;color:rgba(255,255,255,.45);margin-bottom:.7rem;position:relative;">تنتهي في {{ $__planExpiry }}</div>
                @endif
                <a href="{{ route('office.subscriptions.index') }}" style="display:flex;align-items:center;justify-content:center;gap:.35rem;background:rgba(255,255,255,.95);color:#054F31;border-radius:9px;padding:.45rem;font-size:.78rem;font-weight:800;text-decoration:none;transition:background .15s;position:relative;" onmouseover="this.style.background='#fff'" onmouseout="this.style.background='rgba(255,255,255,.95)'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#054F31" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                    تجديد الاشتراك
                </a>
            </div>

            {{-- Support --}}
            <div style="background:#f8fafc;border:1px solid #e8ecf0;border-radius:14px;padding:.9rem;">
                <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.7rem;">
                    <div style="width:30px;height:30px;background:linear-gradient(135deg,#054F31,#0a6b42);border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:15px;height:15px;"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
                    </div>
                    <span style="font-size:.82rem;font-weight:800;color:#111827;">الدعم الفني</span>
                </div>
                <a href="tel:{{ preg_replace('/\s+/','',$__phone) }}" style="display:flex;align-items:center;gap:.6rem;text-decoration:none;padding:.45rem .6rem;border-radius:8px;transition:background .12s;margin-bottom:.3rem;" onmouseover="this.style.background='#f0fdf4'" onmouseout="this.style.background='transparent'">
                    <div style="width:24px;height:24px;background:#e8f5e9;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:12px;height:12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                    </div>
                    <span style="font-size:.75rem;color:#374151;font-weight:600;">{{ $__phone }}</span>
                </a>
                <a href="mailto:{{ $__supportEmail }}" style="display:flex;align-items:center;gap:.6rem;text-decoration:none;padding:.45rem .6rem;border-radius:8px;transition:background .12s;" onmouseover="this.style.background='#f0fdf4'" onmouseout="this.style.background='transparent'">
                    <div style="width:24px;height:24px;background:#e8f5e9;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:12px;height:12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                    </div>
                    <span style="font-size:.75rem;color:#374151;font-weight:600;">{{ $__supportEmail }}</span>
                </a>
            </div>

        </div>
    </aside>

    {{-- ══════════════════════════════════════════
         MAIN: navbar (dark green) + content
    ══════════════════════════════════════════ --}}
    <div style="flex:1;display:flex;flex-direction:column;min-width:0;height:100vh;overflow:hidden;background:#f4f6f9;">

        {{-- TOP NAVBAR --}}
        <header style="flex-shrink:0;height:64px;background:#054F31;display:flex;align-items:center;justify-content:space-between;padding:0 1.5rem;position:relative;z-index:100;overflow:visible;">

            {{-- Right: logo text (RTL = first) --}}
            <div style="display:flex;align-items:center;gap:.875rem;">
                <div style="width:42px;height:42px;border-radius:14px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                </div>
                <div class="nav-brand-text">
                    <div style="color:#fff;font-weight:800;font-size:.95rem;line-height:1.2;">نظام ميري</div>
                    <div style="color:rgba(255,255,255,.5);font-size:.72rem;">لإدارة الاستقدام</div>
                </div>
            </div>

            {{-- Left: hamburger + user + bell (RTL = last) --}}
            <div style="display:flex;align-items:center;gap:1rem;">

                {{-- Bell Dropdown --}}
                @php
                    try{
                        $__notifs = \App\Models\NotificationRecipient::with('notification')
                            ->where('channel','inapp')->where('recipient_type','office')
                            ->where('recipient_id',$__office?->id)->where('status','sent')
                            ->orderByDesc('created_at')->limit(6)->get();
                        $unreadCount = $__notifs->whereNull('read_at')->count();
                    }catch(\Exception $e){$__notifs=collect();$unreadCount=0;}
                @endphp
                <div style="position:relative;" id="notif-wrap">
                    <button onclick="toggleNotif(event)" style="position:relative;background:none;border:none;cursor:pointer;color:rgba(255,255,255,.85);padding:6px;border-radius:10px;transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,.12)'" onmouseout="this.style.background='transparent'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:22px;height:22px;display:block;"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
                        @if($unreadCount>0)
                            <span style="position:absolute;top:2px;right:2px;width:16px;height:16px;background:#ef4444;color:#fff;font-size:.6rem;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #054F31;">{{ $unreadCount>9?'9+':$unreadCount }}</span>
                        @endif
                    </button>

                    {{-- Dropdown Panel --}}
                    <div id="notif-panel" style="display:none;position:absolute;top:calc(100% + 14px);left:0;width:360px;background:#fff;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,0,.2);z-index:9999;overflow:hidden;border:1px solid #e5e7eb;animation:notifSlide .18s ease;">

                        {{-- Header --}}
                        <div style="background:linear-gradient(135deg,#054F31,#0a6b42);padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;">
                            <div style="display:flex;align-items:center;gap:.6rem;">
                                <div style="width:34px;height:34px;border-radius:10px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
                                </div>
                                <div>
                                    <div style="color:#fff;font-weight:800;font-size:.9rem;">الإشعارات</div>
                                    @if($unreadCount>0)
                                        <div style="color:rgba(255,255,255,.65);font-size:.7rem;">{{ $unreadCount }} إشعار غير مقروء</div>
                                    @else
                                        <div style="color:rgba(255,255,255,.65);font-size:.7rem;">كل الإشعارات مقروءة</div>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('office.notifications.index') }}" style="background:rgba(255,255,255,.15);color:#fff;font-size:.72rem;font-weight:700;text-decoration:none;padding:.35rem .75rem;border-radius:8px;border:1px solid rgba(255,255,255,.2);">عرض الكل</a>
                        </div>

                        {{-- List --}}
                        <div style="max-height:360px;overflow-y:auto;">
                            @forelse($__notifs as $__nr)
                                @php $__n = $__nr->notification; $__isUnread = is_null($__nr->read_at); @endphp
                                <a href="{{ route('office.notifications.index') }}" style="display:flex;align-items:flex-start;gap:.875rem;padding:.9rem 1.25rem;border-bottom:1px solid #f3f4f6;text-decoration:none;background:{{ $__isUnread ? '#f0fdf4' : '#fff' }};transition:background .15s;" onmouseover="this.style.background='{{ $__isUnread ? '#dcfce7' : '#f9fafb' }}'" onmouseout="this.style.background='{{ $__isUnread ? '#f0fdf4' : '#fff' }}'">
                                    {{-- Icon --}}
                                    <div style="width:40px;height:40px;border-radius:14px;background:{{ $__isUnread ? '#d1fae5' : '#f3f4f6' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ $__isUnread ? '#054F31' : '#9ca3af' }}" style="width:19px;height:19px;"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
                                    </div>
                                    {{-- Content --}}
                                    <div style="flex:1;min-width:0;">
                                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.2rem;">
                                            <div style="font-size:.83rem;font-weight:{{ $__isUnread ? '700' : '500' }};color:{{ $__isUnread ? '#111827' : '#374151' }};white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px;">{{ $__n?->title ?? 'إشعار جديد' }}</div>
                                            @if($__isUnread)<div style="width:8px;height:8px;background:#054F31;border-radius:50%;flex-shrink:0;"></div>@endif
                                        </div>
                                        <div style="font-size:.75rem;color:#6b7280;line-height:1.45;margin-bottom:.3rem;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ Str::limit($__n?->body ?? '', 75) }}</div>
                                        <div style="display:flex;align-items:center;gap:.35rem;font-size:.68rem;color:#9ca3af;">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:11px;height:11px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                            {{ $__nr->created_at?->diffForHumans() }}
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div style="padding:3rem 1rem;text-align:center;">
                                    <div style="width:64px;height:64px;border-radius:20px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="#d1d5db" style="width:30px;height:30px;"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
                                    </div>
                                    <div style="font-size:.9rem;font-weight:700;color:#374151;margin-bottom:.3rem;">لا توجد إشعارات</div>
                                    <div style="font-size:.78rem;color:#9ca3af;">ستظهر هنا الإشعارات الجديدة</div>
                                </div>
                            @endforelse
                        </div>

                        {{-- Footer --}}
                        @if($__notifs->isNotEmpty())
                        <div style="padding:.875rem 1.25rem;background:#f9fafb;border-top:1px solid #f3f4f6;display:flex;align-items:center;justify-content:center;">
                            <a href="{{ route('office.notifications.index') }}" style="display:inline-flex;align-items:center;gap:.4rem;font-size:.8rem;color:#054F31;font-weight:700;text-decoration:none;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"/></svg>
                                عرض جميع الإشعارات
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- User Dropdown --}}
                <div style="position:relative;" id="user-wrap">
                    <button onclick="toggleUser(event)" style="display:flex;align-items:center;gap:.625rem;background:none;border:none;cursor:pointer;padding:4px 8px;border-radius:12px;transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='transparent'">
                        <div style="width:38px;height:38px;border-radius:50%;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;" id="nav-avatar">
                            @if($__office?->image)
                                <img src="{{ $__office->image_url }}" style="width:38px;height:38px;object-fit:cover;" alt=""
                                     onerror="this.style.display='none';document.getElementById('nav-avatar-fallback').style.display='flex'">
                                <span id="nav-avatar-fallback" style="display:none;width:100%;height:100%;align-items:center;justify-content:center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                </span>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                            @endif
                        </div>
                        <div class="user-detail" style="text-align:right;">
                            <div style="color:#fff;font-weight:700;font-size:.875rem;line-height:1.2;">{{ $__office?->name }}</div>
                            <div style="color:rgba(255,255,255,.5);font-size:.7rem;">مدير المكتب</div>
                        </div>
                        <svg class="user-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="rgba(255,255,255,.6)" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                    </button>

                    {{-- User Dropdown Panel --}}
                    <div id="user-panel" style="display:none;position:absolute;top:calc(100% + 10px);left:0;min-width:220px;background:#fff;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,.2);z-index:9999;overflow:hidden;border:1px solid #e5e7eb;animation:notifSlide .18s ease;">

                        {{-- User info header --}}
                        <div style="padding:1rem 1.1rem;background:linear-gradient(135deg,#054F31,#0a6b42);">
                            <div style="display:flex;align-items:center;gap:.75rem;">
                                <div style="width:42px;height:42px;border-radius:50%;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;" id="dd-avatar">
                                    @if($__office?->image)
                                        <img src="{{ $__office->image_url }}" style="width:42px;height:42px;object-fit:cover;" alt=""
                                             onerror="this.style.display='none';document.getElementById('dd-avatar-fallback').style.display='flex'">
                                        <span id="dd-avatar-fallback" style="display:none;width:100%;height:100%;align-items:center;justify-content:center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:20px;height:20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                        </span>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:20px;height:20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <div style="color:#fff;font-weight:800;font-size:.88rem;">{{ $__office?->name }}</div>
                                    <div style="color:rgba(255,255,255,.6);font-size:.72rem;">{{ $__office?->email }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Menu items --}}
                        <div style="padding:.4rem 0;">
                            <a href="{{ route('office.profile.edit') }}" style="display:flex;align-items:center;gap:.75rem;padding:.75rem 1.1rem;text-decoration:none;color:#374151;font-size:.85rem;font-weight:500;transition:background .12s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                                <div style="width:32px;height:32px;border-radius:9px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                </div>
                                الملف الشخصي
                            </a>
                            <a href="{{ route('office.settings.edit') }}" style="display:flex;align-items:center;gap:.75rem;padding:.75rem 1.1rem;text-decoration:none;color:#374151;font-size:.85rem;font-weight:500;transition:background .12s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                                <div style="width:32px;height:32px;border-radius:9px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                </div>
                                الإعدادات
                            </a>
                            <div style="margin:.3rem .8rem;border-top:1px solid #f3f4f6;"></div>
                            <a href="{{ route('office.logout') }}" onclick="return confirm('هل تريد تسجيل الخروج؟')" style="display:flex;align-items:center;gap:.75rem;padding:.75rem 1.1rem;text-decoration:none;color:#dc2626;font-size:.85rem;font-weight:600;transition:background .12s;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
                                <div style="width:32px;height:32px;border-radius:9px;background:#fef2f2;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"/></svg>
                                </div>
                                تسجيل الخروج
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Hamburger (mobile) --}}
                <button onclick="openSidebar()" id="hamburger" style="color:#fff;background:none;border:none;cursor:pointer;display:none;padding:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
            </div>
        </header>

        {{-- CONTENT --}}
        <main style="flex:1;overflow-y:auto;padding:1.25rem 1.5rem 2rem;background:#f4f6f9;">
            @if(session('success'))<div class="alert alert-success" style="margin-bottom:1rem;">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert alert-error" style="margin-bottom:1rem;">{{ session('error') }}</div>@endif
            @if(session('warning'))<div class="alert alert-warning" style="margin-bottom:1rem;">{{ session('warning') }}</div>@endif
            @yield('content')
        </main>
    </div>
</div>

<style>
    @media(max-width:767px){
        #hamburger{display:block!important}
        .nav-brand-text{display:none!important}
        .user-detail{display:none!important}
        .user-chevron{display:none!important}
        aside#sidebar{position:fixed!important;right:0;top:0;bottom:0;z-index:150;transform:translateX(110%);transition:transform .28s ease;width:260px!important}
        aside#sidebar.open{transform:translateX(0)!important}
        #notif-panel{width:calc(100vw - 2rem)!important;right:auto!important;left:1rem!important;}
        #user-panel{width:calc(100vw - 2rem)!important;left:1rem!important;}
        header{padding:0 .875rem!important}
        #user-wrap button{gap:.4rem!important}
    }
    @keyframes notifSlide{from{opacity:0;transform:translateY(-8px)}to{opacity:1;transform:translateY(0)}}
</style>
<script>
function openSidebar(){document.getElementById('sidebar').classList.add('open');document.getElementById('overlay').style.display='block';}
function closeSidebar(){document.getElementById('sidebar').classList.remove('open');document.getElementById('overlay').style.display='none';}
function toggleUser(e){
    e.stopPropagation();
    var p=document.getElementById('user-panel');
    var n=document.getElementById('notif-panel');
    if(n) n.style.display='none';
    p.style.display = p.style.display==='none'?'block':'none';
}
function toggleNotif(e){
    e.stopPropagation();
    var p=document.getElementById('notif-panel');
    p.style.display = p.style.display==='none'?'block':'none';
}
document.addEventListener('click',function(e){
    var nw=document.getElementById('notif-wrap');
    var uw=document.getElementById('user-wrap');
    if(nw && !nw.contains(e.target)){var p=document.getElementById('notif-panel');if(p) p.style.display='none';}
    if(uw && !uw.contains(e.target)){var p=document.getElementById('user-panel');if(p) p.style.display='none';}
});
</script>
@stack('scripts')
</body>
</html>
