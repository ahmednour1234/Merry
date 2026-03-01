<?php

namespace App\Filament\Office\Resources\BookingResource\Pages;

use App\Enums\BookingStatus;
use App\Filament\Office\Resources\BookingResource;
use App\Models\CvBooking;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('reset_all')
                ->label('إعادة تعيين جميع الحجوزات النشطة')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('إعادة تعيين جميع الحجوزات النشطة')
                ->modalDescription('سيتم رفض جميع الحجوزات النشطة (قيد الانتظار ومقبولة) للمكتب.')
                ->modalSubmitActionLabel('نعم، إعادة التعيين')
                ->action(function () {
                    $office = Auth::guard('office-panel')->user();
                    
                    $affected = CvBooking::on('system')
                        ->where('office_id', $office->id)
                        ->whereIn('status', BookingStatus::activeStatuses())
                        ->update([
                            'status' => BookingStatus::REJECTED->value,
                            'updated_at' => now(),
                        ]);

                    Notification::make()
                        ->title("تم رفض {$affected} حجز")
                        ->success()
                        ->send();
                }),
        ];
    }
}
