<?php

namespace App\Filament\Office\Widgets;

use App\Models\OfficeSubscription;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class SubscriptionInfoWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $office = Auth::guard('office-panel')->user();
        $subscription = OfficeSubscription::on('system')
            ->with(['plan.translations'])
            ->where('office_id', $office->id)
            ->where('active', true)
            ->orderByDesc('ends_at')
            ->first();

        if (!$subscription) {
            return [
                Stat::make('الخطة الحالية', 'لا يوجد اشتراك نشط')
                    ->description('لم يتم الاشتراك في أي خطة')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger'),
            ];
        }

        $planName = $subscription->plan?->translations->where('lang_code', 'ar')->first()?->name
            ?? $subscription->plan?->translations->first()?->name
            ?? $subscription->plan?->name
            ?? $subscription->plan_code;

        $daysUntilRenewal = now()->diffInDays($subscription->ends_at, false);
        $renewalText = $daysUntilRenewal > 0 
            ? "متبقي {$daysUntilRenewal} يوم" 
            : "منتهي";

        return [
            Stat::make('الخطة الحالية', $planName)
                ->description("الحالة: " . match($subscription->status) {
                    'active' => 'نشط',
                    'pending' => 'قيد الانتظار',
                    'cancelled' => 'ملغي',
                    'expired' => 'منتهي',
                    default => $subscription->status,
                })
                ->icon('heroicon-o-credit-card')
                ->color($subscription->status === 'active' ? 'success' : 'warning'),
            
            Stat::make('موعد التجديد القادم', $subscription->ends_at->format('Y-m-d'))
                ->description($renewalText)
                ->icon('heroicon-o-calendar')
                ->color($daysUntilRenewal > 7 ? 'success' : ($daysUntilRenewal > 0 ? 'warning' : 'danger')),
            
            Stat::make('التجديد التلقائي', $subscription->auto_renew ? 'مفعل' : 'معطل')
                ->description($subscription->auto_renew ? 'سيتم التجديد تلقائياً' : 'لن يتم التجديد تلقائياً')
                ->icon($subscription->auto_renew ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                ->color($subscription->auto_renew ? 'success' : 'gray'),
        ];
    }
}
