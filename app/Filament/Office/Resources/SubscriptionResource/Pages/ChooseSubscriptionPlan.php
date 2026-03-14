<?php

namespace App\Filament\Office\Resources\SubscriptionResource\Pages;

use App\Filament\Office\Resources\SubscriptionResource;
use App\Models\OfficeSubscription;
use App\Models\Plan;
use App\Repositories\System\Subscriptions\Contracts\SubscriptionRepositoryInterface;
use App\Services\SubscriptionService;
use Filament\Actions\Action as FilamentAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ChooseSubscriptionPlan extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = SubscriptionResource::class;

    protected string $view = 'filament.office.pages.choose-subscription-plan';

    public ?string $couponCode = null;

    public function mount(): void
    {
        $this->couponCode = null;
    }

    public function getTitle(): string
    {
        return 'اختيار الباقة';
    }

    public function table(Table $table): Table
    {
        $office = Auth::guard('office-panel')->user();

        return $table
            ->query(
                Plan::on('system')
                    ->with(['translations', 'features'])
                    ->where('active', true)
                    ->orderBy('base_price')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الباقة')
                    ->getStateUsing(fn (Plan $record): string => $record->translations->firstWhere('lang_code', 'ar')?->name
                        ?? $record->translations->first()?->name
                        ?? $record->name)
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where(function (Builder $innerQuery) use ($search): Builder {
                            return $innerQuery
                                ->where('name', 'like', "%{$search}%")
                                ->orWhereHas('translations', fn (Builder $translationsQuery): Builder => $translationsQuery->where('name', 'like', "%{$search}%"));
                        });
                    }),
                Tables\Columns\TextColumn::make('description')
                    ->label('الوصف')
                    ->getStateUsing(fn (Plan $record): string => $record->translations->firstWhere('lang_code', 'ar')?->description
                        ?? $record->translations->first()?->description
                        ?? $record->description
                        ?? 'لا يوجد وصف')
                    ->wrap()
                    ->limit(60),
                Tables\Columns\TextColumn::make('final_price')
                    ->label('السعر')
                    ->getStateUsing(function (Plan $record): string {
                        $priced = app(SubscriptionService::class)->priced($record->code, $this->couponCode);
                        $amount = number_format((float) ($priced['price'] ?? $record->base_price), 2);
                        $currency = $priced['currency'] ?? $record->base_currency;

                        return "{$amount} {$currency}";
                    }),
                Tables\Columns\TextColumn::make('billing_cycle')
                    ->label('الدورة')
                    ->formatStateUsing(fn (string $state): string => $state === 'annual' ? 'سنوي' : 'شهري'),
                Tables\Columns\IconColumn::make('is_current')
                    ->label('الحالية')
                    ->boolean()
                    ->getStateUsing(fn (Plan $record): bool => $this->isCurrentPlan($record->code)),
            ])
            ->actions([
                FilamentAction::make('show_features')
                    ->label('عرض المميزات')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->modalHeading(fn (Plan $record): string => 'مميزات باقة ' . ($record->translations->firstWhere('lang_code', 'ar')?->name ?? $record->translations->first()?->name ?? $record->name))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('إغلاق')
                    ->modalContent(function (Plan $record) {
                        return view('filament.office.pages.partials.plan-features-modal', [
                            'features' => $record->features->where('active', true),
                        ]);
                    }),
                FilamentAction::make('subscribe')
                    ->label('اشتراك')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('تأكيد الاشتراك')
                    ->modalDescription('هل تريد الاشتراك في هذه الباقة؟ سيتم استبدال الاشتراك الحالي إذا وجد.')
                    ->modalSubmitActionLabel('تأكيد الاشتراك')
                    ->modalCancelActionLabel('إلغاء')
                    ->action(function (Plan $record): void {
                        $this->subscribe($record->code);
                    })
                    ->visible(fn (Plan $record): bool => ! $this->isCurrentPlan($record->code)),
            ])
            ->defaultSort('base_price');
    }

    public function subscribe(string $planCode): void
    {
        $office = Auth::guard('office-panel')->user();
        $svc = app(SubscriptionService::class);
        $subsRepo = app(SubscriptionRepositoryInterface::class);

        $priced = $svc->priced($planCode, $this->couponCode);

        if (! $priced) {
            Notification::make()
                ->title('الخطة غير متاحة')
                ->danger()
                ->send();

            return;
        }

        $subsRepo->createForOffice(
            $office->id,
            $planCode,
            $priced['currency'],
            $priced['price'],
            [
                'features' => $priced['features'] ?? [],
                'coupon' => $this->couponCode,
            ]
        );

        Notification::make()
            ->title('تم الاشتراك بنجاح')
            ->success()
            ->send();

        $this->redirect(SubscriptionResource::getUrl());
    }

    protected function isCurrentPlan(string $planCode): bool
    {
        return $this->getCurrentSubscription()?->plan_code === $planCode;
    }

    public function toggleAutoRenew($subscriptionId): void
    {
        $office = Auth::guard('office-panel')->user();
        $subsRepo = app(SubscriptionRepositoryInterface::class);

        $sub = OfficeSubscription::on('system')
            ->where('id', $subscriptionId)
            ->where('office_id', $office->id)
            ->first();

        if (! $sub) {
            Notification::make()
                ->title('لا يوجد اشتراك نشط')
                ->danger()
                ->send();

            return;
        }

        $currentSubscriptionId = OfficeSubscription::on('system')
            ->where('office_id', $office->id)
            ->where('status', 'active')
            ->where('active', true)
            ->where('ends_at', '>=', now())
            ->orderByDesc('ends_at')
            ->value('id');

        if (! $sub->auto_renew && $sub->id !== $currentSubscriptionId) {
            Notification::make()
                ->title('يمكن تفعيل التجديد التلقائي للباقة الحالية فقط')
                ->danger()
                ->send();

            return;
        }

        $updated = $subsRepo->setAutoRenew($sub->id, ! $sub->auto_renew);

        Notification::make()
            ->title($updated?->auto_renew ? 'تم تفعيل التجديد التلقائي' : 'تم إلغاء التجديد التلقائي')
            ->success()
            ->send();
    }

    public function getCurrentSubscription()
    {
        $office = Auth::guard('office-panel')->user();

        return OfficeSubscription::on('system')
            ->with(['plan.translations', 'plan.features'])
            ->where('office_id', $office->id)
            ->where('status', 'active')
            ->where('active', true)
            ->where('ends_at', '>=', now())
            ->orderByDesc('ends_at')
            ->first();
    }
}
