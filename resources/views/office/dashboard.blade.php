@extends('office.layouts.app')

@section('title', 'الرئيسية')
@section('page-title', 'الرئيسية')

@push('styles')
<style>
    .dash-stat {
        background:#fff; border-radius:14px; padding:1.1rem 1.25rem;
        box-shadow:0 1px 3px rgba(0,0,0,0.07);
        display:flex; align-items:center; justify-content:space-between;
    }
    .dash-stat .icon-box {
        width:52px; height:52px; border-radius:14px;
        display:flex; align-items:center; justify-content:center; flex-shrink:0;
    }
    .dash-stat .icon-box svg { width:26px; height:26px; }
    .dash-stat .num { font-size:2rem; font-weight:900; color:#111827; line-height:1; }
    .dash-stat .lbl { font-size:0.8rem; color:#6b7280; font-weight:500; margin-bottom:0.3rem; }
    .dash-stat .sub { font-size:0.75rem; font-weight:600; }
    .dash-stat .sub.up   { color:#059669; }
    .dash-stat .sub.muted{ color:#d1d5db; }

    .section-card { background:#fff; border-radius:14px; box-shadow:0 1px 3px rgba(0,0,0,0.07); overflow:hidden; }
    .section-header { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; border-bottom:1px solid #f3f4f6; }
    .section-header h3 { font-size:0.95rem; font-weight:700; color:#111827; margin:0; }
    .section-body { padding:1.25rem; }

    .cv-row { display:flex; align-items:center; gap:0.75rem; padding:0.7rem 1.25rem; border-bottom:1px solid #f9fafb; }
    .cv-row:last-child { border-bottom:none; }
    .cv-avatar { width:34px; height:34px; border-radius:50%; background:#f0fdf4; border:1px solid #bbf7d0; display:flex; align-items:center; justify-content:center; flex-shrink:0; }

    /* Upload zone */
    .upload-zone { border:2px dashed #d1fae5; border-radius:12px; padding:2rem 1rem; text-align:center; }

    @media (max-width: 900px) {
        .dash-grid-2 { grid-template-columns:1fr !important; }
        .dash-grid-4 { grid-template-columns:1fr 1fr !important; }
    }
    @media (max-width: 600px) {
        .dash-grid-4 { grid-template-columns:1fr !important; }
    }
</style>
@endpush

@section('content')

{{-- ── Welcome ── --}}
<div class="section-card" style="margin-bottom:1.25rem;padding:1.25rem 1.5rem;">
    <div style="font-size:1.3rem;font-weight:800;color:#111827;margin-bottom:0.2rem;">
        👋 مرحباً، <span style="color:#054F31;">{{ $office->name }}</span>
    </div>
    <div style="color:#9ca3af;font-size:0.875rem;">إليك ملخص أعمال مكتبك اليوم</div>
</div>

{{-- ── 4 Stat Cards ── --}}
<div class="dash-grid-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.25rem;">

    {{-- CVs --}}
    <div class="dash-stat">
        <div>
            <div class="lbl">عدد السير الذاتية</div>
            <div class="num">{{ $totalCvs }}</div>
            @if($pendingCvs > 0)
                <div class="sub up">+{{ $pendingCvs }} اليوم</div>
            @else
                <div class="sub muted">لا يوجد معلق</div>
            @endif
        </div>
        <div class="icon-box" style="background:#ecfdf5;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
        </div>
    </div>

    {{-- Bookings (Clients) --}}
    <div class="dash-stat">
        <div>
            <div class="lbl">عدد العملاء</div>
            <div class="num">{{ $totalBookings }}</div>
            @if($activeBookings > 0)
                <div class="sub up">+{{ $activeBookings }} هذا الأسبوع</div>
            @else
                <div class="sub muted">لا يوجد جديد</div>
            @endif
        </div>
        <div class="icon-box" style="background:#fff7ed;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ea580c"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
        </div>
    </div>

    {{-- Subscriptions --}}
    <div class="dash-stat">
        <div>
            <div class="lbl">عدد الاشتراكات</div>
            <div class="num">{{ $totalSubscriptions }}</div>
            @if($subscriptionCounts['active'] > 0)
                <div class="sub up">+{{ $subscriptionCounts['active'] }} نشط</div>
            @else
                <div class="sub muted">لا يوجد نشط</div>
            @endif
        </div>
        <div class="icon-box" style="background:#eff6ff;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2563eb"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg>
        </div>
    </div>

    {{-- Favorites --}}
    <div class="dash-stat">
        <div>
            <div class="lbl">آخر السير الذاتية</div>
            <div class="num">{{ $totalFavorites }}</div>
            <div class="sub muted">مرات الإضافة للمفضلة</div>
        </div>
        <div class="icon-box" style="background:#fdf4ff;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9333ea"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
        </div>
    </div>
</div>

{{-- ── Main Grid: Chart (left) + CV Table (right) ── --}}
<div class="dash-grid-2" style="display:grid;grid-template-columns:280px 1fr;gap:1.25rem;margin-bottom:1.25rem;align-items:start;">

    {{-- Donut Chart --}}
    <div class="section-card">
        <div class="section-header"><h3>حالة الاشتراكات</h3></div>
        <div class="section-body">
            @if($totalSubscriptions > 0)
                <div style="display:flex;justify-content:center;position:relative;margin-bottom:1rem;">
                    <canvas id="subscriptionChart" width="160" height="160"></canvas>
                    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;pointer-events:none;">
                        <div style="font-size:1.7rem;font-weight:900;color:#111827;line-height:1;">{{ $totalSubscriptions }}</div>
                        <div style="font-size:0.62rem;color:#9ca3af;margin-top:2px;">إجمالي الاشتراكات</div>
                    </div>
                </div>
                <div style="display:flex;flex-direction:column;gap:0.55rem;margin-bottom:1rem;">
                    @foreach([['نشط','#10b981','active'],['قيد الانتظار','#f59e0b','pending'],['ملغي','#ef4444','cancelled'],['منتهي','#9ca3af','expired']] as [$label,$color,$key])
                    <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.82rem;">
                        <span style="width:10px;height:10px;border-radius:50%;background:{{$color}};flex-shrink:0;display:inline-block;"></span>
                        <span style="color:#374151;flex:1;">{{ $label }}</span>
                        <span style="font-weight:700;color:#111827;">{{ $subscriptionCounts[$key] }}</span>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('office.subscriptions.index') }}" style="display:block;text-align:center;font-size:0.8rem;color:#054F31;font-weight:600;text-decoration:none;border-top:1px solid #f3f4f6;padding-top:0.75rem;">عرض جميع الاشتراكات &larr;</a>
            @else
                <div style="text-align:center;padding:2rem 0;color:#9ca3af;font-size:0.875rem;">لا يوجد اشتراكات بعد</div>
            @endif
        </div>
    </div>

    {{-- CV Table --}}
    <div class="section-card">
        <div class="section-header">
            <h3>آخر السير الذاتية المضافة</h3>
            <a href="{{ route('office.cvs.create') }}" style="font-size:0.8rem;color:#054F31;font-weight:700;text-decoration:none;background:#ecfdf5;border:1px solid #a7f3d0;padding:0.3rem 0.9rem;border-radius:8px;">+ إضافة</a>
        </div>

        @if($recentCvs->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>الجنسية</th>
                        <th>تاريخ الإضافة</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentCvs as $cv)
                    @php
                        $natName = $cv->nationality?->translations->where('lang_code','ar')->first()?->name
                                ?? $cv->nationality?->translations->first()?->name
                                ?? $cv->nationality_code ?? '—';
                        $statusMap = [
                            'pending'      => ['label'=>'جديد',         'class'=>'badge-new'],
                            'approved'     => ['label'=>'مقبول',        'class'=>'badge-success'],
                            'rejected'     => ['label'=>'مرفوض',        'class'=>'badge-danger'],
                            'frozen'       => ['label'=>'مجمد',         'class'=>'badge-gray'],
                            'under_review' => ['label'=>'قيد المراجعة', 'class'=>'badge-warning'],
                        ];
                        $st = $statusMap[$cv->status] ?? ['label'=>$cv->status,'class'=>'badge-gray'];
                    @endphp
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:0.625rem;">
                                <div class="cv-avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:15px;height:15px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                </div>
                                <span style="font-weight:600;font-size:0.85rem;">CV #{{ $cv->id }}</span>
                            </div>
                        </td>
                        <td style="font-size:0.85rem;">{{ $natName }}</td>
                        <td style="color:#9ca3af;font-size:0.78rem;direction:ltr;text-align:right;">{{ $cv->created_at->format('Y-m-d H:i') }}</td>
                        <td><span class="badge {{ $st['class'] }}">{{ $st['label'] }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="padding:0.75rem 1.25rem;border-top:1px solid #f3f4f6;">
                <a href="{{ route('office.cvs.index') }}" style="font-size:0.8rem;color:#054F31;font-weight:600;text-decoration:none;">عرض جميع السير الذاتية &larr;</a>
            </div>
        @else
            <div style="text-align:center;padding:3rem 0;color:#9ca3af;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d1d5db" style="width:44px;height:44px;margin:0 auto 0.75rem;display:block;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                <div style="font-size:0.9rem;margin-bottom:0.5rem;">لا توجد سير ذاتية بعد</div>
                <a href="{{ route('office.cvs.create') }}" style="color:#054F31;font-weight:700;font-size:0.875rem;">أضف سيرتك الأولى</a>
            </div>
        @endif
    </div>
</div>

{{-- ── Bottom Grid: Files uploaded (left) + Upload zone (right) ── --}}
<div class="dash-grid-2" style="display:grid;grid-template-columns:280px 1fr;gap:1.25rem;margin-bottom:1.5rem;align-items:start;">

    {{-- Uploaded Files --}}
    <div class="section-card">
        <div class="section-header"><h3>الملفات المرفوعة</h3></div>
        <div class="section-body" style="padding:0.5rem 0;">
            @if($recentFiles->count() > 0)
                @foreach($recentFiles as $file)
                <div style="display:flex;align-items:center;gap:0.75rem;padding:0.6rem 1.25rem;border-bottom:1px solid #f9fafb;">
                    <div style="width:34px;height:34px;background:#fef2f2;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:0.82rem;font-weight:600;color:#374151;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $file->file_original_name ?? 'cv_'.$file->id.'.pdf' }}</div>
                        <div style="font-size:0.7rem;color:#9ca3af;">{{ $file->file_size ? round($file->file_size/1024,1).' KB' : 'PDF' }}</div>
                    </div>
                    <a href="{{ route('office.cvs.download', $file->id) }}" style="color:#054F31;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                    </a>
                </div>
                @endforeach
                <div style="padding:0.7rem 1.25rem;text-align:center;">
                    <span style="font-size:0.75rem;color:#9ca3af;">{{ $recentFiles->count() }} ملفات جاهزة للرفع</span>
                </div>
            @else
                <div style="text-align:center;padding:2rem;color:#9ca3af;font-size:0.875rem;">لا توجد ملفات مرفوعة</div>
            @endif
        </div>
    </div>

    {{-- Upload Zone --}}
    <div style="display:flex;flex-direction:column;gap:1rem;">
        <div class="section-card">
            <div class="section-body">
                <div class="upload-zone">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#10b981" style="width:44px;height:44px;margin:0 auto 0.75rem;display:block;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                    </svg>
                    <div style="font-size:1rem;font-weight:700;color:#111827;margin-bottom:0.35rem;">اسحب الملفات هنا أو اضغط للرفع</div>
                    <div style="font-size:0.78rem;color:#9ca3af;margin-bottom:1rem;">(الحد الأقصى 20 ملف) PDF, JPG, PNG</div>
                    <a href="{{ route('office.cvs.create') }}" class="btn-primary" style="padding:0.6rem 2rem;">↑ اختيار ملفات</a>
                </div>
            </div>
        </div>
        <a href="{{ route('office.cvs.index') }}" style="display:flex;align-items:center;justify-content:center;gap:0.5rem;background:#d4a017;color:#fff;border-radius:14px;padding:0.9rem;font-size:0.95rem;font-weight:700;text-decoration:none;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
            رفع جميع الملفات
        </a>
    </div>
</div>

@endsection

@push('scripts')
<script>
@if($totalSubscriptions > 0)
(function() {
    const ctx = document.getElementById('subscriptionChart');
    if (!ctx) return;
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['نشط', 'قيد الانتظار', 'ملغي', 'منتهي'],
            datasets: [{
                data: [{{ $subscriptionCounts['active'] }}, {{ $subscriptionCounts['pending'] }}, {{ $subscriptionCounts['cancelled'] }}, {{ $subscriptionCounts['expired'] }}],
                backgroundColor: ['#10b981','#f59e0b','#ef4444','#d1d5db'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: false,
            cutout: '72%',
            plugins: { legend: { display: false }, tooltip: { rtl: true } }
        }
    });
})();
@endif
</script>
@endpush


@section('content')

{{-- Welcome --}}
<div style="background:#fff;border-radius:14px;padding:1.25rem 1.5rem;margin-top:1.25rem;margin-bottom:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,0.05);display:flex;align-items:center;justify-content:space-between;">
    <div>
        <div style="font-size:1.2rem;font-weight:800;color:#111827;margin-bottom:0.2rem;">
            🌟 مرحباً، <span style="color:#054F31;">{{ $office->name }}</span>
        </div>
        <div style="color:#9ca3af;font-size:0.85rem;">إليك ملخص أعمال مكتبك اليوم</div>
    </div>
</div>

{{-- Stat Cards --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.25rem;">

    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <span style="font-size:0.82rem;color:#6b7280;font-weight:500;">عدد السير الذاتية</span>
            <div style="width:40px;height:40px;background:#ecfdf5;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:20px;height:20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
            </div>
        </div>
        <div style="font-size:2.2rem;font-weight:900;color:#111827;line-height:1;margin-bottom:0.4rem;">{{ $totalCvs }}</div>
        @if($pendingCvs > 0)
            <div style="font-size:0.78rem;color:#059669;font-weight:600;">+{{ $pendingCvs }} قيد المراجعة</div>
        @else
            <div style="font-size:0.78rem;color:#d1d5db;">لا يوجد معلق</div>
        @endif
    </div>

    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <span style="font-size:0.82rem;color:#6b7280;font-weight:500;">عدد العملاء</span>
            <div style="width:40px;height:40px;background:#fff7ed;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ea580c" style="width:20px;height:20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
            </div>
        </div>
        <div style="font-size:2.2rem;font-weight:900;color:#111827;line-height:1;margin-bottom:0.4rem;">{{ $totalBookings }}</div>
        @if($activeBookings > 0)
            <div style="font-size:0.78rem;color:#059669;font-weight:600;">+{{ $activeBookings }} هذا الأسبوع</div>
        @else
            <div style="font-size:0.78rem;color:#d1d5db;">لا يوجد جديد</div>
        @endif
    </div>

    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <span style="font-size:0.82rem;color:#6b7280;font-weight:500;">عدد الاشتراكات</span>
            <div style="width:40px;height:40px;background:#eff6ff;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2563eb" style="width:20px;height:20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg>
            </div>
        </div>
        <div style="font-size:2.2rem;font-weight:900;color:#111827;line-height:1;margin-bottom:0.4rem;">{{ $totalSubscriptions }}</div>
        @if($subscriptionCounts['active'] > 0)
            <div style="font-size:0.78rem;color:#059669;font-weight:600;">+{{ $subscriptionCounts['active'] }} نشط</div>
        @else
            <div style="font-size:0.78rem;color:#d1d5db;">لا يوجد نشط</div>
        @endif
    </div>

    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <span style="font-size:0.82rem;color:#6b7280;font-weight:500;">آخر السير الذاتية</span>
            <div style="width:40px;height:40px;background:#fdf4ff;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9333ea" style="width:20px;height:20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
            </div>
        </div>
        <div style="font-size:2.2rem;font-weight:900;color:#111827;line-height:1;margin-bottom:0.4rem;">{{ $totalFavorites }}</div>
        <div style="font-size:0.78rem;color:#6b7280;">مرات الإضافة للمفضلة</div>
    </div>
</div>

{{-- Two-column layout: right=60% (table+bottom), left=40% (chart+files) --}}
<div style="display:grid;grid-template-columns:1fr 1.55fr;gap:1.25rem;">

    {{-- LEFT: Chart + Files --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem;">

        {{-- Donut Chart --}}
        <div class="stat-card">
            <h3 style="font-size:0.95rem;font-weight:700;color:#111827;margin:0 0 1rem;">حالة الاشتراكات</h3>
            @if($totalSubscriptions > 0)
                <div style="position:relative;display:flex;justify-content:center;margin-bottom:1rem;">
                    <canvas id="subscriptionChart" width="170" height="170"></canvas>
                    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;pointer-events:none;">
                        <div style="font-size:1.6rem;font-weight:900;color:#111827;line-height:1;">{{ $totalSubscriptions }}</div>
                        <div style="font-size:0.65rem;color:#9ca3af;margin-top:2px;">إجمالي الاشتراكات</div>
                    </div>
                </div>
                <div style="display:flex;flex-direction:column;gap:0.5rem;">
                    <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.82rem;">
                        <span style="width:10px;height:10px;border-radius:50%;background:#10b981;flex-shrink:0;display:inline-block;"></span>
                        <span style="color:#374151;flex:1;">نشط</span>
                        <span style="font-weight:700;color:#111827;">{{ $subscriptionCounts['active'] }}</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.82rem;">
                        <span style="width:10px;height:10px;border-radius:50%;background:#f59e0b;flex-shrink:0;display:inline-block;"></span>
                        <span style="color:#374151;flex:1;">قيد الانتظار</span>
                        <span style="font-weight:700;color:#111827;">{{ $subscriptionCounts['pending'] }}</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.82rem;">
                        <span style="width:10px;height:10px;border-radius:50%;background:#ef4444;flex-shrink:0;display:inline-block;"></span>
                        <span style="color:#374151;flex:1;">ملغي</span>
                        <span style="font-weight:700;color:#111827;">{{ $subscriptionCounts['cancelled'] }}</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.82rem;">
                        <span style="width:10px;height:10px;border-radius:50%;background:#9ca3af;flex-shrink:0;display:inline-block;"></span>
                        <span style="color:#374151;flex:1;">منتهي</span>
                        <span style="font-weight:700;color:#111827;">{{ $subscriptionCounts['expired'] }}</span>
                    </div>
                </div>
                <div style="margin-top:0.875rem;border-top:1px solid #f3f4f6;padding-top:0.75rem;text-align:center;">
                    <a href="{{ route('office.subscriptions.index') }}" style="font-size:0.8rem;color:#054F31;font-weight:600;text-decoration:none;">عرض جميع الاشتراكات &larr;</a>
                </div>
            @else
                <div style="text-align:center;padding:1.5rem 0;color:#9ca3af;font-size:0.875rem;">لا يوجد اشتراكات بعد</div>
            @endif
        </div>

        {{-- Uploaded Files --}}
        <div class="stat-card">
            <h3 style="font-size:0.95rem;font-weight:700;color:#111827;margin:0 0 1rem;">الملفات المرفوعة</h3>
            @if($recentFiles->count() > 0)
                <div style="display:flex;flex-direction:column;gap:0.75rem;">
                    @foreach($recentFiles as $file)
                        <div style="display:flex;align-items:center;gap:0.75rem;">
                            <div style="width:36px;height:36px;background:#fee2e2;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div style="font-size:0.82rem;font-weight:600;color:#374151;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $file->file_original_name ?? ('cv_'.$file->id.'.pdf') }}</div>
                                <div style="font-size:0.72rem;color:#9ca3af;">{{ $file->file_size ? round($file->file_size/1024,1).' KB' : 'PDF' }}</div>
                            </div>
                            <a href="{{ route('office.cvs.download', $file->id) }}" style="color:#054F31;text-decoration:none;flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div style="margin-top:0.875rem;border-top:1px solid #f3f4f6;padding-top:0.75rem;display:flex;align-items:center;justify-content:space-between;">
                    <span style="font-size:0.75rem;color:#9ca3af;">{{ $recentFiles->count() }} ملفات خلال اليوم</span>
                    <a href="{{ route('office.cvs.index') }}" style="font-size:0.8rem;color:#054F31;font-weight:600;text-decoration:none;">عرض جميع الملفات</a>
                </div>
            @else
                <div style="text-align:center;padding:1rem 0;color:#9ca3af;font-size:0.875rem;">لا توجد ملفات مرفوعة</div>
            @endif
        </div>
    </div>

    {{-- RIGHT: CV Table + bottom cards --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem;">

        {{-- Recent CVs --}}
        <div class="stat-card" style="flex:1;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                <h3 style="font-size:0.95rem;font-weight:700;color:#111827;margin:0;">آخر السير الذاتية المضافة</h3>
                <a href="{{ route('office.cvs.create') }}" style="font-size:0.8rem;color:#054F31;font-weight:600;text-decoration:none;background:#ecfdf5;border:1px solid #a7f3d0;padding:0.3rem 0.875rem;border-radius:7px;">+ إضافة</a>
            </div>

            @if($recentCvs->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الجنسية</th>
                            <th>تاريخ الإضافة</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentCvs as $cv)
                        @php
                            $natName = $cv->nationality?->translations->where('lang_code','ar')->first()?->name
                                    ?? $cv->nationality?->translations->first()?->name
                                    ?? $cv->nationality_code ?? '—';
                            $statusMap = [
                                'pending'  => ['label'=>'جديد',        'class'=>'badge-new'],
                                'approved' => ['label'=>'مقبول',       'class'=>'badge-success'],
                                'rejected' => ['label'=>'مرفوض',       'class'=>'badge-danger'],
                                'frozen'   => ['label'=>'مجمد',        'class'=>'badge-gray'],
                                'under_review' => ['label'=>'قيد المراجعة','class'=>'badge-warning'],
                            ];
                            $st = $statusMap[$cv->status] ?? ['label'=>$cv->status,'class'=>'badge-gray'];
                        @endphp
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:0.625rem;">
                                    <div style="width:32px;height:32px;border-radius:50%;background:#f0fdf4;border:1px solid #bbf7d0;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:15px;height:15px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                    </div>
                                    <span style="font-weight:600;font-size:0.85rem;">CV #{{ $cv->id }}</span>
                                </div>
                            </td>
                            <td style="font-size:0.85rem;">{{ $natName }}</td>
                            <td style="color:#9ca3af;font-size:0.78rem;">{{ $cv->created_at->format('Y-m-d H:i') }}</td>
                            <td><span class="badge {{ $st['class'] }}">{{ $st['label'] }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align:center;padding:2.5rem 0;color:#9ca3af;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d1d5db" style="width:44px;height:44px;margin:0 auto 0.75rem;display:block;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                    لا توجد سير ذاتية بعد<br>
                    <a href="{{ route('office.cvs.create') }}" style="color:#054F31;font-weight:600;font-size:0.875rem;margin-top:0.5rem;display:inline-block;">أضف سيرتك الأولى</a>
                </div>
            @endif
        </div>

        {{-- Bottom row: Subscription + Support --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">

            {{-- Subscription --}}
            <div style="background:#fff;border-radius:12px;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);border:2px solid #d4a017;">
                <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.875rem;">
                    <span style="font-size:1.1rem;">👑</span>
                    <span style="font-size:0.875rem;font-weight:700;color:#92400e;">الباقة الحالية</span>
                </div>
                @if($activeSubscription)
                    <div style="font-size:1.05rem;font-weight:800;color:#111827;margin-bottom:0.3rem;">{{ $planName }}</div>
                    <div style="font-size:0.78rem;color:#9ca3af;margin-bottom:0.5rem;">تنتهي في {{ $activeSubscription->ends_at->format('Y-m-d') }}</div>
                    <div style="font-size:0.82rem;font-weight:700;color:{{ $daysLeft > 7 ? '#059669' : ($daysLeft > 0 ? '#d97706' : '#dc2626') }};">
                        {{ $daysLeft > 0 ? "متبقي $daysLeft يوم" : 'منتهية الصلاحية' }}
                    </div>
                    <a href="{{ route('office.subscriptions.index') }}" style="display:block;margin-top:1rem;text-align:center;background:#d4a017;color:#fff;border-radius:8px;padding:0.5rem;font-size:0.82rem;font-weight:700;text-decoration:none;">تجديد الاشتراك</a>
                @else
                    <div style="font-size:0.875rem;color:#6b7280;margin-bottom:0.875rem;">لا يوجد اشتراك نشط</div>
                    <a href="{{ route('office.subscriptions.index') }}" style="display:block;text-align:center;background:#054F31;color:#fff;border-radius:8px;padding:0.5rem;font-size:0.82rem;font-weight:700;text-decoration:none;">اشترك الآن</a>
                @endif
            </div>

            {{-- Support --}}
            <div style="background:#fff;border-radius:12px;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);border:1px solid #e5e7eb;">
                <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:0.875rem;">
                    <div style="width:34px;height:34px;background:#ecfdf5;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:17px;height:17px;"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" /></svg>
                    </div>
                    <span style="font-size:0.875rem;font-weight:700;color:#111827;">الدعم الفني</span>
                </div>
                <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.8rem;color:#374151;margin-bottom:0.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:15px;height:15px;flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                    +966 50 123 4567
                </div>
                <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.8rem;color:#374151;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:15px;height:15px;flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                    support@office.com
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Nationalities ── --}}
@if($nationalities->count() > 0)
<div class="stat-card" style="margin-top:1.25rem;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
        <div style="display:flex;align-items:center;gap:0.6rem;">
            <div style="width:36px;height:36px;background:linear-gradient(135deg,#054F31,#0a6b42);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" /></svg>
            </div>
            <div>
                <div style="font-size:0.95rem;font-weight:700;color:#111827;">الجنسيات المتاحة</div>
                <div style="font-size:0.72rem;color:#9ca3af;">{{ $nationalities->count() }} جنسية نشطة</div>
            </div>
        </div>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:0.75rem;">
        @foreach($nationalities as $nat)
        @php
            $arName = $nat->translations->where('lang_code','ar')->first()?->name
                   ?? $nat->translations->first()?->name
                   ?? $nat->name;
            $flagUrl = $nat->image ?: 'https://flagcdn.com/w40/'.strtolower($nat->code).'.png';
        @endphp
        <div style="display:flex;flex-direction:column;align-items:center;gap:0.5rem;background:#f8fafc;border:1px solid #e8ecf0;border-radius:12px;padding:0.875rem 0.5rem;transition:all .15s;cursor:default;" onmouseover="this.style.background='#f0fdf4';this.style.borderColor='#86efac'" onmouseout="this.style.background='#f8fafc';this.style.borderColor='#e8ecf0'">
            <img src="{{ $flagUrl }}" alt="{{ $arName }}"
                 style="width:40px;height:28px;object-fit:cover;border-radius:4px;box-shadow:0 1px 3px rgba(0,0,0,.15);"
                 onerror="this.style.display='none'">
            <span style="font-size:0.78rem;font-weight:600;color:#374151;text-align:center;line-height:1.3;">{{ $arName }}</span>
            <span style="font-size:0.65rem;color:#9ca3af;font-family:monospace;">{{ $nat->code }}</span>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>
@if($totalSubscriptions > 0)
(function() {
    const ctx = document.getElementById('subscriptionChart');
    if (!ctx) return;
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['نشط', 'قيد الانتظار', 'ملغي', 'منتهي'],
            datasets: [{
                data: [{{ $subscriptionCounts['active'] }}, {{ $subscriptionCounts['pending'] }}, {{ $subscriptionCounts['cancelled'] }}, {{ $subscriptionCounts['expired'] }}],
                backgroundColor: ['#10b981','#f59e0b','#ef4444','#d1d5db'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: false,
            cutout: '70%',
            plugins: { legend: { display: false }, tooltip: { rtl: true } }
        }
    });
})();
@endif
</script>
@endpush
