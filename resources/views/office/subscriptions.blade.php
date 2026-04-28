@extends('office.layouts.app')

@section('title', 'الاشتراكات')

@push('styles')
<style>
    .plan-card{background:#fff;border-radius:16px;padding:1.5rem;box-shadow:0 2px 8px rgba(0,0,0,.06);border:1.5px solid #e5e7eb;position:relative;transition:all .2s;display:flex;flex-direction:column;}
    .plan-card:hover{border-color:#a7f3d0;box-shadow:0 6px 24px rgba(5,79,49,.1);transform:translateY(-2px);}
    .plan-card.active-plan{border-color:#054F31;box-shadow:0 6px 24px rgba(5,79,49,.15);}
    .plan-feature{font-size:.8rem;color:#374151;display:flex;align-items:center;gap:.5rem;padding:.28rem 0;}
    .plan-feature svg{width:14px;height:14px;flex-shrink:0;}
    .days-bar{height:6px;border-radius:99px;background:#e5e7eb;overflow:hidden;margin-top:.5rem;}
    .days-bar-fill{height:100%;border-radius:99px;background:linear-gradient(90deg,#054F31,#34d399);transition:width .5s ease;}
</style>
@endpush

@section('content')

{{-- ══ Current Subscription Hero ══ --}}
@if($currentSubscription)
@php
    $planName = $currentSubscription->plan?->translations->where('lang_code','ar')->first()?->name
             ?? $currentSubscription->plan?->translations->first()?->name
             ?? $currentSubscription->plan_code;
    $daysLeft  = (int) round(now()->diffInDays($currentSubscription->ends_at, false));
    $totalDays = (int) round($currentSubscription->starts_at->diffInDays($currentSubscription->ends_at));
    $pct       = $totalDays > 0 ? max(0, min(100, round($daysLeft / $totalDays * 100))) : 0;
    $barColor  = $daysLeft <= 7 ? '#ef4444' : ($daysLeft <= 30 ? '#f59e0b' : '#054F31');
@endphp
<div style="background:linear-gradient(135deg,#054F31 0%,#0a7a4d 100%);border-radius:20px;padding:1.75rem 2rem;color:#fff;margin-bottom:1.75rem;position:relative;overflow:hidden;">
    {{-- decorative circles --}}
    <div style="position:absolute;top:-30px;left:-30px;width:140px;height:140px;border-radius:50%;background:rgba(255,255,255,.05);pointer-events:none;"></div>
    <div style="position:absolute;bottom:-40px;left:100px;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none;"></div>

    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1.25rem;position:relative;">
        <div style="flex:1;min-width:200px;">
            <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.6rem;">
                <div style="width:48px;height:48px;border-radius:14px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="width:24px;height:24px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/></svg>
                </div>
                <div>
                    <div style="font-size:.75rem;opacity:.65;margin-bottom:.1rem;">الباقة الحالية</div>
                    <div style="font-size:1.4rem;font-weight:800;">{{ $planName }}</div>
                </div>
            </div>

            <div style="display:flex;align-items:center;flex-wrap:wrap;gap:.5rem;margin-bottom:1rem;">
                <span style="background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.25);padding:.25rem .8rem;border-radius:99px;font-size:.75rem;font-weight:700;">
                    {{ match($currentSubscription->status) { 'active'=>'نشط','pending'=>'قيد المراجعة','cancelled'=>'ملغي','expired'=>'منتهي',default=>$currentSubscription->status } }}
                </span>
                <span style="background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);padding:.25rem .8rem;border-radius:99px;font-size:.75rem;">
                    تجديد تلقائي: {{ $currentSubscription->auto_renew ? 'مفعّل' : 'معطل' }}
                </span>
            </div>

            <div style="font-size:.8rem;opacity:.75;margin-bottom:.5rem;">
                تنتهي في <span style="font-weight:700;opacity:1;">{{ $currentSubscription->ends_at->format('Y-m-d') }}</span>
                &nbsp;·&nbsp;
                @if($daysLeft > 0)
                    متبقي <span style="font-weight:700;color:#86efac;">{{ $daysLeft }} يوم</span>
                @else
                    <span style="color:#fca5a5;font-weight:700;">منتهية</span>
                @endif
            </div>

            <div class="days-bar" style="max-width:260px;">
                <div class="days-bar-fill" style="width:{{ $pct }}%;background:{{ $daysLeft<=7 ? '#fca5a5' : ($daysLeft<=30 ? '#fde68a' : 'linear-gradient(90deg,#22c55e,#86efac)' ) }};"></div>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:.6rem;min-width:170px;">
            <form method="POST" action="{{ route('office.subscriptions.toggle-auto-renew', $currentSubscription->id) }}">
                @csrf
                <button type="submit" style="width:100%;background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.3);color:#fff;border-radius:10px;padding:.6rem 1rem;font-family:'Cairo',sans-serif;font-size:.82rem;font-weight:700;cursor:pointer;transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
                    {{ $currentSubscription->auto_renew ? 'إلغاء التجديد التلقائي' : 'تفعيل التجديد التلقائي' }}
                </button>
            </form>
            @if(in_array($currentSubscription->status, ['active','pending']))
            <form method="POST" action="{{ route('office.subscriptions.cancel', $currentSubscription->id) }}" onsubmit="return confirm('هل تريد إلغاء الاشتراك؟')">
                @csrf
                <button type="submit" style="width:100%;background:rgba(239,68,68,.25);border:1.5px solid rgba(239,68,68,.45);color:#fca5a5;border-radius:10px;padding:.6rem 1rem;font-family:'Cairo',sans-serif;font-size:.82rem;font-weight:700;cursor:pointer;transition:background .15s;" onmouseover="this.style.background='rgba(239,68,68,.35)'" onmouseout="this.style.background='rgba(239,68,68,.25)'">
                    إلغاء الاشتراك
                </button>
            </form>
            @endif
        </div>
    </div>
</div>
@else
<div style="background:#fff;border-radius:16px;border:2px dashed #fde68a;padding:1.5rem;margin-bottom:1.75rem;display:flex;align-items:center;gap:1rem;">
    <div style="width:46px;height:46px;border-radius:14px;background:#fef3c7;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#f59e0b" style="width:24px;height:24px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/></svg>
    </div>
    <div>
        <div style="font-weight:700;color:#92400e;font-size:.9rem;">لا يوجد اشتراك نشط</div>
        <div style="font-size:.8rem;color:#b45309;margin-top:.2rem;">اختر إحدى الباقات أدناه للاشتراك والاستمتاع بجميع المزايا</div>
    </div>
</div>
@endif

{{-- ══ Available Plans ══ --}}
<div style="margin-bottom:2rem;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
        <div style="font-size:1rem;font-weight:800;color:#111827;display:flex;align-items:center;gap:.5rem;">
            <div style="width:4px;height:20px;background:linear-gradient(#054F31,#0a6b42);border-radius:2px;"></div>
            الباقات المتاحة
        </div>
        <div style="font-size:.78rem;color:#9ca3af;">{{ $plans->count() }} باقة متاحة</div>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:1rem;">
        @foreach($plans as $plan)
        @php
            $pName = $plan->translations->where('lang_code','ar')->first()?->name
                  ?? $plan->translations->first()?->name
                  ?? $plan->name;
            $isCurrentPlan = $currentSubscription && $currentSubscription->plan_code === $plan->code && $currentSubscription->status === 'active';
        @endphp
        <div class="plan-card {{ $isCurrentPlan ? 'active-plan' : '' }}">
            @if($isCurrentPlan)
                <div style="position:absolute;top:-1px;right:1.25rem;background:linear-gradient(135deg,#054F31,#0a6b42);color:#fff;font-size:.68rem;font-weight:800;padding:.25rem .75rem;border-radius:0 0 10px 10px;">باقتك الحالية</div>
            @endif
            <div style="margin-bottom:1rem;">
                <div style="font-size:1.05rem;font-weight:800;color:#111827;margin-bottom:.3rem;{{ $isCurrentPlan ? 'padding-top:.5rem;' : '' }}">{{ $pName }}</div>
                @if($plan->price ?? false)
                    <div style="font-size:.85rem;color:#6b7280;">{{ number_format($plan->price ?? 0, 2) }} <span style="font-size:.7rem;">{{ $plan->currency_code ?? 'USD' }}</span></div>
                @endif
            </div>

            @if($plan->features && $plan->features->count() > 0)
                <div style="flex:1;margin-bottom:1.25rem;">
                    @foreach($plan->features->take(5) as $feature)
                        <div class="plan-feature">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#059669"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            {{ $feature->translations?->where('lang_code','ar')->first()?->label ?? $feature->translations?->first()?->label ?? $feature->key }}
                        </div>
                    @endforeach
                </div>
            @else
                <div style="flex:1;"></div>
            @endif

            @if(!$isCurrentPlan)
                <form method="POST" action="{{ route('office.subscriptions.subscribe') }}">
                    @csrf
                    <input type="hidden" name="plan_code" value="{{ $plan->code }}">
                    <button type="submit" style="width:100%;background:linear-gradient(135deg,#054F31,#0a6b42);color:#fff;border:none;border-radius:10px;padding:.7rem;font-family:'Cairo',sans-serif;font-size:.875rem;font-weight:700;cursor:pointer;transition:opacity .15s;" onmouseover="this.style.opacity='.88'" onmouseout="this.style.opacity='1'">اشترك الآن</button>
                </form>
            @else
                <button disabled style="width:100%;background:#f3f4f6;color:#9ca3af;border:none;border-radius:10px;padding:.7rem;font-family:'Cairo',sans-serif;font-size:.875rem;cursor:not-allowed;font-weight:600;">الباقة الحالية</button>
            @endif
        </div>
        @endforeach
    </div>
</div>

{{-- ══ Subscription History ══ --}}
@if($subscriptions->count() > 0)
<div>
    <div style="font-size:1rem;font-weight:800;color:#111827;display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <div style="width:4px;height:20px;background:linear-gradient(#054F31,#0a6b42);border-radius:2px;"></div>
        سجل الاشتراكات
    </div>
    <div style="background:#fff;border-radius:16px;box-shadow:0 2px 10px rgba(0,0,0,.06);overflow:hidden;">
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
                    $subStatus = ['active'=>['label'=>'نشط','class'=>'badge-success'],'pending'=>['label'=>'قيد الانتظار','class'=>'badge-warning'],'cancelled'=>['label'=>'ملغي','class'=>'badge-danger'],'expired'=>['label'=>'منتهي','class'=>'badge-gray']][$sub->status] ?? ['label'=>$sub->status,'class'=>'badge-gray'];
                @endphp
                <tr>
                    <td style="font-weight:700;color:#111827;">{{ $subPlanName }}</td>
                    <td style="font-weight:600;color:#374151;">{{ $sub->price ? number_format($sub->price,2).' '.$sub->currency_code : '—' }}</td>
                    <td style="font-size:.82rem;color:#6b7280;">{{ $sub->starts_at?->format('Y-m-d') ?? '—' }}</td>
                    <td style="font-size:.82rem;color:#6b7280;">{{ $sub->ends_at?->format('Y-m-d') ?? '—' }}</td>
                    <td><span class="badge {{ $subStatus['class'] }}">{{ $subStatus['label'] }}</span></td>
                    <td>
                        @if($sub->status === 'expired')
                        <form method="POST" action="{{ route('office.subscriptions.renew', $sub->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" style="background:#ecfdf5;border:1px solid #a7f3d0;color:#065f46;border-radius:8px;padding:.3rem .7rem;font-family:'Cairo',sans-serif;font-size:.78rem;font-weight:600;cursor:pointer;">تجديد</button>
                        </form>
                        @else
                            <span style="color:#d1d5db;font-size:.8rem;">—</span>
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
