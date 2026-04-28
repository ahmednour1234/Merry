@extends('office.layouts.app')

@section('title', 'الاشتراكات')
@section('page-title', 'الاشتراكات')

@section('content')

{{-- Current subscription card --}}
@if($currentSubscription)
@php
    $planName = $currentSubscription->plan?->translations->where('lang_code','ar')->first()?->name
             ?? $currentSubscription->plan?->translations->first()?->name
             ?? $currentSubscription->plan_code;
    $daysLeft = (int) round(now()->diffInDays($currentSubscription->ends_at, false));
@endphp
<div style="background:linear-gradient(135deg,#054F31,#0a7a4d);border-radius:14px;padding:1.5rem;color:#fff;margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
    <div>
        <div style="font-size:0.8rem;opacity:0.75;margin-bottom:0.25rem;">الباقة الحالية</div>
        <div style="font-size:1.5rem;font-weight:800;">{{ $planName }}</div>
        <div style="font-size:0.85rem;opacity:0.85;margin-top:0.4rem;">
            تنتهي في {{ $currentSubscription->ends_at->format('Y-m-d') }}
            @if($daysLeft > 0)
                &nbsp;&middot;&nbsp; متبقي {{ $daysLeft }} يوم
            @else
                &nbsp;&middot;&nbsp; <span style="color:#fca5a5;">منتهية</span>
            @endif
        </div>
        <div style="margin-top:0.75rem;display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
            <span style="background:rgba(255,255,255,0.2);padding:0.25rem 0.75rem;border-radius:9999px;font-size:0.78rem;">
                {{ match($currentSubscription->status) { 'active' => 'نشط', 'pending' => 'قيد المراجعة', 'cancelled' => 'ملغي', 'expired' => 'منتهي', default => $currentSubscription->status } }}
            </span>
            <span style="background:rgba(255,255,255,0.2);padding:0.25rem 0.75rem;border-radius:9999px;font-size:0.78rem;">
                تجديد تلقائي: {{ $currentSubscription->auto_renew ? 'مفعّل' : 'معطل' }}
            </span>
        </div>
    </div>
    <div style="display:flex;flex-direction:column;gap:0.5rem;">
        <form method="POST" action="{{ route('office.subscriptions.toggle-auto-renew', $currentSubscription->id) }}">
            @csrf
            <button type="submit" style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);color:#fff;border-radius:8px;padding:0.5rem 1rem;font-family:'Cairo',sans-serif;font-size:0.82rem;cursor:pointer;width:100%;">
                {{ $currentSubscription->auto_renew ? 'إلغاء التجديد التلقائي' : 'تفعيل التجديد التلقائي' }}
            </button>
        </form>
        @if(in_array($currentSubscription->status, ['active','pending']))
        <form method="POST" action="{{ route('office.subscriptions.cancel', $currentSubscription->id) }}" onsubmit="return confirm('هل تريد إلغاء الاشتراك؟')">
            @csrf
            <button type="submit" style="background:rgba(239,68,68,0.3);border:1px solid rgba(239,68,68,0.5);color:#fca5a5;border-radius:8px;padding:0.5rem 1rem;font-family:'Cairo',sans-serif;font-size:0.82rem;cursor:pointer;width:100%;">
                إلغاء الاشتراك
            </button>
        </form>
        @endif
    </div>
</div>
@else
<div style="background:#fef3c7;border:1px solid #fde68a;border-radius:10px;padding:1.25rem;margin-bottom:1.5rem;display:flex;align-items:center;gap:0.75rem;">
    <span style="font-size:0.9rem;color:#92400e;font-weight:600;">لا يوجد اشتراك نشط. اختر إحدى الباقات أدناه للاشتراك.</span>
</div>
@endif

{{-- Available Plans --}}
<div style="margin-bottom:2rem;">
    <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 1rem;">الباقات المتاحة</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1rem;">
        @foreach($plans as $plan)
        @php
            $pName = $plan->translations->where('lang_code','ar')->first()?->name
                  ?? $plan->translations->first()?->name
                  ?? $plan->name;
            $isCurrentPlan = $currentSubscription && $currentSubscription->plan_code === $plan->code && $currentSubscription->status === 'active';
        @endphp
        <div style="background:#fff;border-radius:12px;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,0.06);border:{{ $isCurrentPlan ? '2px solid #054F31' : '1px solid #e5e7eb' }};position:relative;">
            @if($isCurrentPlan)
                <div style="position:absolute;top:-10px;right:1rem;background:#054F31;color:#fff;font-size:0.72rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:9999px;">باقتك الحالية</div>
            @endif
            <div style="font-size:1.1rem;font-weight:800;color:#111827;margin-bottom:0.5rem;">{{ $pName }}</div>
            @if($plan->features && $plan->features->count() > 0)
                <ul style="list-style:none;padding:0;margin:0 0 1.25rem;display:flex;flex-direction:column;gap:0.4rem;">
                    @foreach($plan->features->take(5) as $feature)
                        <li style="font-size:0.82rem;color:#374151;display:flex;align-items:center;gap:0.5rem;">
                            <span style="color:#059669;">✓</span>
                            {{ $feature->translations?->where('lang_code','ar')->first()?->label ?? $feature->translations?->first()?->label ?? $feature->key }}
                        </li>
                    @endforeach
                </ul>
            @endif
            @if(!$isCurrentPlan)
                <form method="POST" action="{{ route('office.subscriptions.subscribe') }}">
                    @csrf
                    <input type="hidden" name="plan_code" value="{{ $plan->code }}">
                    <button type="submit" class="btn-primary" style="width:100%;">اشترك الآن</button>
                </form>
            @else
                <button disabled style="width:100%;background:#f3f4f6;color:#9ca3af;border:none;border-radius:8px;padding:0.6rem;font-family:'Cairo',sans-serif;font-size:0.9rem;cursor:not-allowed;">الباقة الحالية</button>
            @endif
        </div>
        @endforeach
    </div>
</div>

{{-- Subscription History --}}
@if($subscriptions->count() > 0)
<div>
    <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 1rem;">سجل الاشتراكات</h3>
    <div style="background:#fff;border-radius:10px;box-shadow:0 1px 4px rgba(0,0,0,0.06);overflow:hidden;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>الباقة</th>
                    <th>السعر</th>
                    <th>تاريخ البداية</th>
                    <th>تاريخ الانتهاء</th>
                    <th>الحالة</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptions as $sub)
                @php
                    $subPlanName = $sub->plan?->translations->where('lang_code','ar')->first()?->name ?? $sub->plan?->translations->first()?->name ?? $sub->plan_code;
                    $subStatus = ['active' => ['label'=>'نشط','class'=>'badge-success'],'pending' => ['label'=>'قيد الانتظار','class'=>'badge-warning'],'cancelled' => ['label'=>'ملغي','class'=>'badge-danger'],'expired' => ['label'=>'منتهي','class'=>'badge-gray']][$sub->status] ?? ['label'=>$sub->status,'class'=>'badge-gray'];
                @endphp
                <tr>
                    <td style="font-weight:600;">{{ $subPlanName }}</td>
                    <td>{{ $sub->price ? number_format($sub->price,2).' '.$sub->currency_code : '—' }}</td>
                    <td style="font-size:0.82rem;color:#6b7280;">{{ $sub->starts_at?->format('Y-m-d') ?? '—' }}</td>
                    <td style="font-size:0.82rem;color:#6b7280;">{{ $sub->ends_at?->format('Y-m-d') ?? '—' }}</td>
                    <td><span class="badge {{ $subStatus['class'] }}">{{ $subStatus['label'] }}</span></td>
                    <td>
                        @if($sub->status === 'expired')
                        <form method="POST" action="{{ route('office.subscriptions.renew', $sub->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" style="background:#ecfdf5;border:1px solid #a7f3d0;color:#065f46;border-radius:6px;padding:0.25rem 0.6rem;font-family:'Cairo',sans-serif;font-size:0.78rem;cursor:pointer;">تجديد</button>
                        </form>
                        @else
                            <span style="color:#d1d5db;font-size:0.8rem;">—</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
