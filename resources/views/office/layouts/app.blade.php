<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'مكتب النخبة للاستقدام') - مري</title>

    <!-- Google Fonts: Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        * { font-family: 'Cairo', sans-serif; }
        body { background-color: #f4f6f9; }

        /* Sidebar */
        .sidebar { width: 260px; background: #054F31; min-height: 100vh; flex-shrink: 0; }
        .sidebar-logo { padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-nav a {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.75rem 1.25rem; color: rgba(255,255,255,0.75);
            text-decoration: none; font-size: 0.95rem; transition: all 0.2s;
            border-right: 3px solid transparent;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: rgba(255,255,255,0.1); color: #fff;
            border-right-color: #A8E6CF;
        }
        .sidebar-nav a svg { width: 20px; height: 20px; flex-shrink: 0; }

        /* Topbar */
        .topbar { background: #fff; border-bottom: 1px solid #e5e7eb; height: 64px; }

        /* Cards */
        .stat-card { background: #fff; border-radius: 12px; padding: 1.25rem; box-shadow: 0 1px 4px rgba(0,0,0,0.06); }
        .stat-card .icon-wrap { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-card .icon-wrap svg { width: 24px; height: 24px; }

        /* Tables */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { background: #f9fafb; font-size: 0.8rem; font-weight: 600; color: #6b7280; padding: 0.75rem 1rem; text-align: right; }
        .data-table td { padding: 0.85rem 1rem; border-bottom: 1px solid #f3f4f6; font-size: 0.9rem; color: #374151; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #f9fafb; }

        /* Badges */
        .badge { display: inline-flex; align-items: center; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.78rem; font-weight: 600; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-danger  { background: #fee2e2; color: #991b1b; }
        .badge-gray    { background: #f3f4f6; color: #374151; }
        .badge-blue    { background: #dbeafe; color: #1e40af; }
        .badge-new     { background: #ecfdf5; color: #059669; border: 1px solid #6ee7b7; }

        /* Alerts */
        .alert { padding: 0.9rem 1.25rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.9rem; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .alert-warning { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }

        /* Buttons */
        .btn-primary { background: #054F31; color: #fff; border: none; border-radius: 8px; padding: 0.6rem 1.25rem; cursor: pointer; font-family: 'Cairo', sans-serif; font-size: 0.9rem; font-weight: 600; transition: background 0.2s; }
        .btn-primary:hover { background: #043d26; }
        .btn-secondary { background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; border-radius: 8px; padding: 0.6rem 1.25rem; cursor: pointer; font-family: 'Cairo', sans-serif; font-size: 0.9rem; font-weight: 500; transition: all 0.2s; }
        .btn-secondary:hover { background: #e5e7eb; }
        .btn-danger { background: #ef4444; color: #fff; border: none; border-radius: 8px; padding: 0.6rem 1.25rem; cursor: pointer; font-family: 'Cairo', sans-serif; font-size: 0.9rem; font-weight: 600; }

        /* Form inputs */
        .form-input { width: 100%; border: 1px solid #d1d5db; border-radius: 8px; padding: 0.6rem 0.875rem; font-family: 'Cairo', sans-serif; font-size: 0.9rem; color: #111827; outline: none; transition: border-color 0.2s; }
        .form-input:focus { border-color: #054F31; box-shadow: 0 0 0 3px rgba(5,79,49,0.1); }
        .form-label { display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.375rem; }
        .form-error { color: #dc2626; font-size: 0.8rem; margin-top: 0.25rem; }

        /* Pagination */
        .pagination-wrap { display: flex; gap: 0.375rem; align-items: center; }
        .pagination-wrap a, .pagination-wrap span { padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.85rem; border: 1px solid #d1d5db; color: #374151; text-decoration: none; }
        .pagination-wrap a:hover { background: #f3f4f6; }
        .pagination-wrap .active-page { background: #054F31; color: #fff; border-color: #054F31; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 3px; }
    </style>
    @stack('styles')
</head>
<body>
<div class="flex" style="min-height:100vh;">

    <!-- Sidebar (right) -->
    <aside class="sidebar" id="sidebar">
        <!-- Logo -->
        <div class="sidebar-logo">
            <div class="flex items-center gap-3">
                <div style="width:40px;height:40px;background:rgba(255,255,255,0.15);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:22px;height:22px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>
                </div>
                <div>
                    <div style="color:#fff;font-weight:700;font-size:0.9rem;line-height:1.2;">مكتب النخبة</div>
                    <div style="color:rgba(255,255,255,0.55);font-size:0.72rem;">للاستقدام</div>
                </div>
            </div>
        </div>

        <!-- User mini -->
        <div style="padding:1rem 1.25rem;border-bottom:1px solid rgba(255,255,255,0.08);">
            <div class="flex items-center gap-3">
                <div style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    @if(auth()->guard('office-panel')->user()?->image)
                        <img src="{{ asset('storage/'.auth()->guard('office-panel')->user()->image) }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;" alt="">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                    @endif
                </div>
                <div style="overflow:hidden;">
                    <div style="color:#fff;font-size:0.85rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->guard('office-panel')->user()?->name }}</div>
                    <div style="color:rgba(255,255,255,0.5);font-size:0.72rem;">مدير المكتب</div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav" style="padding:0.75rem 0;">
            <a href="{{ route('office.dashboard') }}" class="{{ request()->routeIs('office.dashboard*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                الرئيسية
            </a>
            <a href="{{ route('office.cvs.index') }}" class="{{ request()->routeIs('office.cvs*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                السير الذاتية
            </a>
            <a href="{{ route('office.cvs.create') }}" class="{{ request()->routeIs('office.cvs.create') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                إضافة سيرة ذاتية
            </a>
            <a href="{{ route('office.bookings.index') }}" class="{{ request()->routeIs('office.bookings*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                الحجوزات
            </a>
            <a href="{{ route('office.subscriptions.index') }}" class="{{ request()->routeIs('office.subscriptions*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg>
                الاشتراكات
            </a>
            <a href="{{ route('office.reports.index') }}" class="{{ request()->routeIs('office.reports*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                التقارير
            </a>
            <a href="{{ route('office.settings.edit') }}" class="{{ request()->routeIs('office.settings*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                الإعدادات
            </a>

            <div style="margin:0.75rem 0;border-top:1px solid rgba(255,255,255,0.08);"></div>

            <a href="{{ route('office.logout') }}" onclick="return confirm('هل تريد تسجيل الخروج؟')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" /></svg>
                تسجيل الخروج
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div style="flex:1;display:flex;flex-direction:column;overflow:hidden;">

        <!-- Topbar -->
        <header class="topbar flex items-center justify-between" style="padding:0 1.5rem;">
            <div class="flex items-center gap-3">
                <!-- Page title -->
                <h1 style="font-size:1.1rem;font-weight:700;color:#111827;">@yield('page-title', 'الرئيسية')</h1>
            </div>

            <div class="flex items-center gap-4">
                <!-- Notifications -->
                <a href="{{ route('office.notifications.index') }}" style="position:relative;color:#6b7280;text-decoration:none;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:22px;height:22px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                    @php
                        $unreadCount = \App\Models\NotificationRecipient::on('system')
                            ->where('channel','inapp')->where('recipient_type','office')
                            ->where('recipient_id', auth()->guard('office-panel')->id())
                            ->where('status','sent')->whereNull('read_at')->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span style="position:absolute;top:-6px;right:-6px;background:#ef4444;color:#fff;font-size:0.65rem;font-weight:700;width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                    @endif
                </a>

                <!-- Profile link -->
                <a href="{{ route('office.profile.edit') }}" style="display:flex;align-items:center;gap:0.5rem;text-decoration:none;color:#374151;">
                    <div style="width:34px;height:34px;border-radius:50%;background:#054F31;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                        @if(auth()->guard('office-panel')->user()?->image)
                            <img src="{{ asset('storage/'.auth()->guard('office-panel')->user()->image) }}" style="width:34px;height:34px;object-fit:cover;" alt="">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                        @endif
                    </div>
                    <span style="font-size:0.875rem;font-weight:600;">{{ auth()->guard('office-panel')->user()?->name }}</span>
                </a>
            </div>
        </header>

        <!-- Page Content -->
        <main style="flex:1;overflow-y:auto;padding:1.5rem;">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
