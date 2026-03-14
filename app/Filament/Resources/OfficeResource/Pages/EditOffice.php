<?php

namespace App\Filament\Resources\OfficeResource\Pages;

use App\Filament\Resources\OfficeResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use App\Models\AuditLog;
use App\Models\Office;
use App\Services\Notifications\NotificationService;
use Filament\Actions;
use Filament\Forms;

class EditOffice extends BaseEditRecord
{
    protected static string $resource = OfficeResource::class;

    public function getTitle(): string
    {
        return 'تعديل مكتب';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('stopOffice')
                ->label('إيقاف المكتب')
                ->icon('heroicon-o-pause-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('إيقاف المكتب')
                ->modalDescription('سيتم إيقاف المكتب وإرسال رسالة توضيحية إلى البريد الإلكتروني الخاص به.')
                ->modalSubmitActionLabel('نعم، إيقاف')
                ->modalCancelActionLabel('إلغاء')
                ->form([
                    Forms\Components\Textarea::make('reason')
                        ->label('سبب الإيقاف')
                        ->rows(3)
                        ->required()
                        ->maxLength(1000),
                    Forms\Components\Textarea::make('message')
                        ->label('الرسالة المرسلة للمكتب')
                        ->rows(4)
                        ->required()
                        ->maxLength(2000),
                ])
                ->action(function (Office $record, array $data): void {
                    $reason = trim((string) ($data['reason'] ?? ''));
                    $message = trim((string) ($data['message'] ?? ''));

                    // Avoid duplicate generic status emails from observer; send custom message instead.
                    Office::withoutEvents(function () use ($record): void {
                        $record->update([
                            'active' => false,
                            'blocked' => true,
                        ]);
                    });

                    $notification = app(NotificationService::class)->createNotification([
                        'type' => 'office_stopped_with_reason',
                        'title' => 'تم إيقاف المكتب',
                        'body' => $message,
                        'data' => [
                            'office_id' => $record->id,
                            'reason' => $reason,
                            'message' => $message,
                        ],
                        'created_by' => auth()->id(),
                    ]);

                    app(NotificationService::class)->notifyOffices($notification, [$record->id], ['inapp', 'email']);

                    AuditLog::create([
                        'tenant_id' => null,
                        'user_id' => auth()->id(),
                        'action' => 'office_stopped_with_reason',
                        'model' => Office::class,
                        'model_id' => $record->id,
                        'request' => [
                            'reason' => $reason,
                            'message' => $message,
                        ],
                        'changes' => [
                            'active' => false,
                            'blocked' => true,
                        ],
                        'ip' => request()->ip(),
                        'ua' => (string) request()->userAgent(),
                        'active' => true,
                        'created_at' => now(),
                    ]);
                })
                ->visible(fn (Office $record): bool => $record->active || ! $record->blocked),
            Actions\DeleteAction::make()
                ->label('حذف مكتب')
                ->modalHeading('تأكيد الحذف')
                ->modalDescription('هل أنت متأكد من حذف هذا المكتب؟')
                ->modalSubmitActionLabel('نعم، احذف')
                ->modalCancelActionLabel('إلغاء'),
        ];
    }
}
