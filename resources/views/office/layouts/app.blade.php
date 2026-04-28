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
            #sidebar{position:fixed;right:0;top:0;bottom:0;z-index:50;transform:translateX(110%);transition:transform .28s ease}
            #sidebar.open{transform:translateX(0)}
        }
    </style>
    @stack('styles')
</head>
<body>
<div id="overlay" onclick="closeSidebar()" style="display:none;position:fixed;inset:0;z-index:40;background:rgba(0,0,0,.45)"></div>

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
         SIDEBAR – white, right side (RTL)
    ══════════════════════════════════════════ --}}
    <aside id="sidebar" style="width:260px;flex-shrink:0;display:flex;flex-direction:column;height:100vh;background:#fff;border-left:1px solid #e5e7eb;overflow:hidden;">

        {{-- Office logo + name --}}
        <div style="padding:1.1rem 1.25rem;border-bottom:1px solid #f3f4f6;display:flex;align-items:center;gap:.875rem;">
            <div style="width:44px;height:44px;border-radius:14px;background:#054F31;display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden;">
                @if($__office?->image)
                    <img src="{{ asset('storage/'.$__office->image) }}" style="width:44px;height:44px;object-fit:cover;" alt="">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                @endif
            </div>
            <div style="overflow:hidden;">
                <div style="font-weight:800;font-size:.9rem;color:#111827;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $__office?->name }}</div>
                <div style="font-size:.72rem;color:#9ca3af;">مرحبا بك في لوحة التحكم</div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav style="flex:1;overflow-y:auto;padding:.5rem 0;">
            <a href="{{ route('office.dashboard') }}" class="nav-link {{ request()->routeIs('office.dashboard*')?'active':'' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                الرئيسية
            </a>
            <a href="{{ route('office.cvs.index') }}" class="nav-link {{ (request()->routeIs('office.cvs*')&&!request()->routeIs('office.cvs.create'))?'active':'' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                السير الذاتية
            </a>
            <a href="{{ route('office.cvs.create') }}" class="nav-link {{ request()->routeIs('office.cvs.create')?'active':'' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                إضافة سيرة ذاتية
            </a>
            <a href="{{ route('office.bookings.index') }}" class="nav-link {{ request()->routeIs('office.bookings*')?'active':'' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>
                العملاء
            </a>
            <a href="{{ route('office.subscriptions.index') }}" class="nav-link {{ request()->routeIs('office.subscriptions*')?'active':'' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/></svg>
                الاشتراكات
            </a>
            <a href="{{ route('office.reports.index') }}" class="nav-link {{ request()->routeIs('office.reports*')?'active':'' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                التقارير
            </a>
            <a href="{{ route('office.settings.edit') }}" class="nav-link {{ request()->routeIs('office.settings*')?'active':'' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                الإعدادات
            </a>
        </nav>

        {{-- Bottom: Subscription + Support + Logout --}}
        <div style="border-top:1px solid #f3f4f6;padding:.875rem;">

            {{-- Subscription card --}}
            <div style="background:linear-gradient(135deg,#054F31 0%,#0a6b42 100%);border-radius:14px;padding:1rem;margin-bottom:.875rem;position:relative;overflow:hidden;">
                <div style="position:absolute;top:-20px;left:-20px;width:80px;height:80px;border-radius:50%;background:rgba(255,255,255,.07);"></div>
                <div style="display:flex;align-items:center;gap:.4rem;margin-bottom:.4rem;">
                    <span style="font-size:.9rem;">👑</span>
                    <span style="font-size:.72rem;color:rgba(255,255,255,.65);">الباقة الحالية</span>
                </div>
                <div style="font-size:1.05rem;font-weight:800;color:#fbbf24;margin-bottom:.25rem;">{{ $__planName }}</div>
                @if($__planExpiry)
                    <div style="font-size:.72rem;color:rgba(255,255,255,.55);margin-bottom:.6rem;">تنتهي في {{ $__planExpiry }}</div>
                @endif
                <a href="{{ route('office.subscriptions.index') }}" style="display:block;text-align:center;background:#fff;color:#054F31;border-radius:8px;padding:.4rem;font-size:.8rem;font-weight:800;text-decoration:none;">تجديد الاشتراك</a>
            </div>

            {{-- Support --}}
            <div style="background:#f9fafb;border-radius:12px;padding:.875rem;margin-bottom:.75rem;">
                <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.6rem;">
                    <div style="width:30px;height:30px;background:#e8f5e9;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:15px;height:15px;"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
                    </div>
                    <span style="font-size:.82rem;font-weight:700;color:#111827;">الدعم الفني</span>
                </div>
                <div style="display:flex;align-items:center;gap:.5rem;font-size:.75rem;color:#6b7280;margin-bottom:.35rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:13px;height:13px;flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                    {{ $__phone }}
                </div>
                <div style="display:flex;align-items:center;gap:.5rem;font-size:.75rem;color:#6b7280;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:13px;height:13px;flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                    {{ $__supportEmail }}
                </div>
            </div>

            {{-- Logout --}}
            <a href="{{ route('office.logout') }}" onclick="return confirm('هل تريد تسجيل الخروج؟')"
               style="display:flex;align-items:center;gap:.5rem;padding:.55rem .875rem;border-radius:10px;font-size:.82rem;font-weight:600;color:#dc2626;text-decoration:none;transition:background .15s;"
               onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"/></svg>
                تسجيل الخروج
            </a>
        </div>
    </aside>

    {{-- ══════════════════════════════════════════
         MAIN: navbar (dark green) + content
    ══════════════════════════════════════════ --}}
    <div style="flex:1;display:flex;flex-direction:column;min-width:0;height:100vh;overflow:hidden;">

        {{-- TOP NAVBAR --}}
        <header style="flex-shrink:0;height:64px;background:#054F31;display:flex;align-items:center;justify-content:space-between;padding:0 1.5rem;">

            {{-- Right: logo text (RTL = first) --}}
            <div style="display:flex;align-items:center;gap:.875rem;">
                <div style="width:42px;height:42px;border-radius:14px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                </div>
                <div>
                    <div style="color:#fff;font-weight:800;font-size:.95rem;line-height:1.2;">نظام ميري</div>
                    <div style="color:rgba(255,255,255,.5);font-size:.72rem;">لإدارة الاستقدام</div>
                </div>
            </div>

            {{-- Left: hamburger + bell + user (RTL = last) --}}
            <div style="display:flex;align-items:center;gap:1rem;">

                {{-- User --}}
                <a href="{{ route('office.profile.edit') }}" style="display:flex;align-items:center;gap:.625rem;text-decoration:none;">
                    <div style="text-align:right;">
                        <div style="color:#fff;font-weight:700;font-size:.875rem;line-height:1.2;">{{ $__office?->name }}</div>
                        <div style="color:rgba(255,255,255,.5);font-size:.7rem;">مدير المكتب</div>
                    </div>
                    <div style="width:38px;height:38px;border-radius:50%;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;">
                        @if($__office?->image)
                            <img src="{{ asset('storage/'.$__office->image) }}" style="width:38px;height:38px;object-fit:cover;" alt="">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                        @endif
                    </div>
                </a>

                {{-- Bell --}}
                @php
                    try{$unreadCount=\App\Models\NotificationRecipient::where('channel','inapp')->where('recipient_type','office')->where('recipient_id',$__office?->id)->where('status','sent')->whereNull('read_at')->count();}catch(\Exception $e){$unreadCount=0;}
                @endphp
                <a href="{{ route('office.notifications.index') }}" style="position:relative;color:rgba(255,255,255,.85);text-decoration:none;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
                    @if($unreadCount>0)
                        <span style="position:absolute;top:-5px;right:-5px;width:17px;height:17px;background:#ef4444;color:#fff;font-size:.6rem;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;">{{ $unreadCount>9?'9+':$unreadCount }}</span>
                    @endif
                </a>

                {{-- Hamburger (mobile) --}}
                <button onclick="openSidebar()" id="hamburger" style="color:#fff;background:none;border:none;cursor:pointer;display:none;padding:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
            </div>
        </header>

        {{-- CONTENT --}}
        <main style="flex:1;overflow-y:auto;padding:0 1.5rem 2rem;">
            @if(session('success'))<div class="alert alert-success" style="margin-top:1.25rem;">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert alert-error" style="margin-top:1.25rem;">{{ session('error') }}</div>@endif
            @if(session('warning'))<div class="alert alert-warning" style="margin-top:1.25rem;">{{ session('warning') }}</div>@endif
            @yield('content')
        </main>
    </div>
</div>

<style>
    @media(max-width:767px){
        #hamburger{display:block!important}
        aside#sidebar{position:fixed!important;right:0;top:0;bottom:0;z-index:50;transform:translateX(110%);transition:transform .28s ease;width:260px!important}
        aside#sidebar.open{transform:translateX(0)!important}
    }
</style>
<script>
function openSidebar(){document.getElementById('sidebar').classList.add('open');document.getElementById('overlay').style.display='block';}
function closeSidebar(){document.getElementById('sidebar').classList.remove('open');document.getElementById('overlay').style.display='none';}
</script>
@stack('scripts')
</body>
</html>
