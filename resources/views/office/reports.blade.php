@extends('office.layouts.app')

@section('title', 'التقارير')
@section('page-title', 'التقارير')

@section('content')

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.5rem;">

    {{-- CVs by status --}}
    <div style="background:#fff;border-radius:12px;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
        <h3 style="font-size:0.95rem;font-weight:700;color:#111827;margin:0 0 1.25rem;display:flex;align-items:center;gap:0.5rem;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:18px;height:18px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            السير الذاتية حسب الحالة
        </h3>
        @php
            $cvLabels = ['pending'=>'قيد الانتظار','approved'=>'موافق عليه','rejected'=>'مرفوض','frozen'=>'مجمد'];
            $cvColors = ['pending'=>'#f59e0b','approved'=>'#10b981','rejected'=>'#ef4444','frozen'=>'#9ca3af'];
            $totalCvs = array_sum($cvsByStatus);
        @endphp
        @if($totalCvs > 0)
        <div style="display:flex;flex-direction:column;gap:0.75rem;">
            @foreach($cvsByStatus as $status => $count)
            @php $pct = $totalCvs > 0 ? round($count/$totalCvs*100) : 0; @endphp
            <div>
                <div style="display:flex;justify-content:space-between;font-size:0.82rem;margin-bottom:0.3rem;">
                    <span style="color:#374151;">{{ $cvLabels[$status] ?? $status }}</span>
                    <span style="font-weight:700;color:#111827;">{{ $count }} ({{ $pct }}%)</span>
                </div>
                <div style="background:#f3f4f6;border-radius:9999px;height:8px;overflow:hidden;">
                    <div style="height:8px;border-radius:9999px;width:{{ $pct }}%;background:{{ $cvColors[$status] ?? '#6b7280' }};"></div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <p style="color:#9ca3af;font-size:0.85rem;text-align:center;margin-top:1rem;">لا توجد بيانات</p>
        @endif
    </div>

    {{-- Bookings by status --}}
    <div style="background:#fff;border-radius:12px;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
        <h3 style="font-size:0.95rem;font-weight:700;color:#111827;margin:0 0 1.25rem;display:flex;align-items:center;gap:0.5rem;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#054F31" style="width:18px;height:18px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
            </svg>
            الحجوزات حسب الحالة
        </h3>
        @php
            $bkLabels = ['pending'=>'قيد الانتظار','accepted'=>'مقبول','rejected'=>'مرفوض','cancelled'=>'ملغي'];
            $bkColors = ['pending'=>'#f59e0b','accepted'=>'#10b981','rejected'=>'#ef4444','cancelled'=>'#9ca3af'];
            $totalBk = array_sum($bookingsByStatus);
        @endphp
        @if($totalBk > 0)
        <div style="display:flex;flex-direction:column;gap:0.75rem;">
            @foreach($bookingsByStatus as $status => $count)
            @php $pct = $totalBk > 0 ? round($count/$totalBk*100) : 0; @endphp
            <div>
                <div style="display:flex;justify-content:space-between;font-size:0.82rem;margin-bottom:0.3rem;">
                    <span style="color:#374151;">{{ $bkLabels[$status] ?? $status }}</span>
                    <span style="font-weight:700;color:#111827;">{{ $count }} ({{ $pct }}%)</span>
                </div>
                <div style="background:#f3f4f6;border-radius:9999px;height:8px;overflow:hidden;">
                    <div style="height:8px;border-radius:9999px;width:{{ $pct }}%;background:{{ $bkColors[$status] ?? '#6b7280' }};"></div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <p style="color:#9ca3af;font-size:0.85rem;text-align:center;margin-top:1rem;">لا توجد بيانات</p>
        @endif
    </div>
</div>

{{-- Subscription history table --}}
@if($subscriptionHistory->count() > 0)
<div style="background:#fff;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);overflow:hidden;">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #f3f4f6;">
        <h3 style="font-size:0.95rem;font-weight:700;color:#111827;margin:0;">سجل الاشتراكات</h3>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>الباقة</th>
                <th>السعر</th>
                <th>البداية</th>
                <th>الانتهاء</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptionHistory as $sub)
            @php
                $sPlan = $sub->plan?->translations->where('lang_code','ar')->first()?->name
                      ?? $sub->plan?->translations->first()?->name
                      ?? $sub->plan_code;
                $sStatus = ['active'=>['label'=>'نشط','class'=>'badge-success'],'pending'=>['label'=>'قيد الانتظار','class'=>'badge-warning'],'cancelled'=>['label'=>'ملغي','class'=>'badge-danger'],'expired'=>['label'=>'منتهي','class'=>'badge-gray']][$sub->status] ?? ['label'=>$sub->status,'class'=>'badge-gray'];
            @endphp
            <tr>
                <td style="font-weight:600;">{{ $sPlan }}</td>
                <td>{{ $sub->price ? number_format($sub->price,2).' '.$sub->currency_code : '—' }}</td>
                <td style="font-size:0.82rem;color:#6b7280;">{{ $sub->starts_at?->format('Y-m-d') ?? '—' }}</td>
                <td style="font-size:0.82rem;color:#6b7280;">{{ $sub->ends_at?->format('Y-m-d') ?? '—' }}</td>
                <td><span class="badge {{ $sStatus['class'] }}">{{ $sStatus['label'] }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection
