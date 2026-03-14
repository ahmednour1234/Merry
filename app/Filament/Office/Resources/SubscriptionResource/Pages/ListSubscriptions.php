<?php

namespace App\Filament\Office\Resources\SubscriptionResource\Pages;

use App\Filament\Office\Resources\SubscriptionResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

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
            Action::make('go_to_plans')
                ->label('اختيار باقة جديدة')
                ->icon('heroicon-o-plus-circle')
                ->color('success')
                ->url(fn (): string => SubscriptionResource::getUrl('plans')),
        ];
    }
}
