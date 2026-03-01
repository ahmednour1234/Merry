<?php

namespace App\Filament\Office\Widgets;

use App\Models\OfficeSubscription;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class SubscriptionWidget extends BaseWidget
{
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
                Stat::make('الاشتراك الحالي', 'لا يوجد اشتراك نشط')
                    ->description('يرجى الاشتراك في إحدى الخطط')
                    ->icon('heroicon-o-x-circle')
                    ->color('warning'),
            ];
        }

        $planName = $subscription->plan->translations->where('lang_code', 'ar')->first()?->name 
            ?? $subscription->plan->translations->first()?->name 
            ?? $subscription->plan->name;

        $endsAt = $subscription->ends_at->format('Y-m-d');
        $daysLeft = now()->diffInDays($subscription->ends_at, false);

        return [
            Stat::make('الخطة الحالية', $planName)
                ->description("ينتهي في: {$endsAt} ({$daysLeft} يوم متبقي)")
                ->icon('heroicon-o-check-circle')
                ->color($daysLeft > 7 ? 'success' : 'warning'),
        ];
    }
}
