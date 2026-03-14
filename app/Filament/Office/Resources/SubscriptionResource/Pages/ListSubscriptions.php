<?php

namespace App\Filament\Office\Resources\SubscriptionResource\Pages;

use App\Filament\Office\Resources\SubscriptionResource;
use App\Models\Plan;
use App\Repositories\System\Subscriptions\Contracts\SubscriptionRepositoryInterface;
use App\Services\SubscriptionService;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListSubscriptions extends ListRecords
{
    protected static string $resource = SubscriptionResource::class;

    public function getTitle(): string
    {
        return 'الاشتراكات';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('subscribe_plan')
                ->label('الاشتراك في باقة')
                ->icon('heroicon-o-plus-circle')
                ->color('success')
                ->form([
                    Select::make('plan_code')
                        ->label('الباقة')
                        ->options(fn (): array => Plan::on('system')
                            ->with('translations')
                            ->where('active', true)
                            ->orderBy('base_price')
                            ->get()
                            ->mapWithKeys(function (Plan $plan): array {
                                $name = $plan->translations->firstWhere('lang_code', 'ar')?->name
                                    ?? $plan->translations->first()?->name
                                    ?? $plan->name;

                                $price = number_format((float) $plan->base_price, 2);

                                return [$plan->code => "{$name} ({$price} {$plan->base_currency})"];
                            })
                            ->all())
                        ->searchable()
                        ->required(),
                    TextInput::make('coupon')
                        ->label('كوبون (اختياري)')
                        ->maxLength(64),
                ])
                ->action(function (array $data): void {
                    $office = Auth::guard('office-panel')->user();

                    if (! $office) {
                        Notification::make()
                            ->title('غير مصرح بهذا الإجراء')
                            ->danger()
                            ->send();

                        return;
                    }

                    $svc = app(SubscriptionService::class);
                    $subsRepo = app(SubscriptionRepositoryInterface::class);

                    $priced = $svc->priced($data['plan_code'], $data['coupon'] ?? null);

                    if (! $priced) {
                        Notification::make()
                            ->title('الخطة غير متاحة')
                            ->danger()
                            ->send();

                        return;
                    }

                    $subsRepo->createForOffice(
                        $office->id,
                        $data['plan_code'],
                        $priced['currency'],
                        $priced['price'],
                        [
                            'features' => $priced['features'] ?? [],
                            'coupon' => $data['coupon'] ?? null,
                        ]
                    );

                    Notification::make()
                        ->title('تم الاشتراك في الباقة بنجاح')
                        ->success()
                        ->send();
                }),
        ];
    }
}
