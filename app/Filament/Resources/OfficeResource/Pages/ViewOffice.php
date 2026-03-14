<?php

namespace App\Filament\Resources\OfficeResource\Pages;

use App\Filament\Resources\OfficeResource;
use App\Models\AuditLog;
use App\Models\Office;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ViewOffice extends ViewRecord
{
    protected static string $resource = OfficeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('createLog')
                ->label('إضافة Log')
                ->icon('heroicon-o-document-plus')
                ->color('warning')
                ->modalHeading('إضافة سجل رسالة')
                ->modalDescription('أدخل تفاصيل السجل الذي تريد إضافته لهذا المكتب.')
                ->modalSubmitActionLabel('حفظ السجل')
                ->modalCancelActionLabel('إلغاء')
                ->form([
                    Forms\Components\Select::make('action')
                        ->label('نوع العملية')
                        ->options([
                            'office_stopped_with_reason' => 'إيقاف',
                            'office_reactivated_with_reason' => 'إعادة تفعيل',
                            'office_message_logged' => 'رسالة فقط',
                        ])
                        ->default('office_message_logged')
                        ->required(),
                    Forms\Components\Textarea::make('reason')
                        ->label('السبب')
                        ->rows(3)
                        ->required()
                        ->maxLength(1000),
                    Forms\Components\Textarea::make('message')
                        ->label('الرسالة')
                        ->rows(4)
                        ->required()
                        ->maxLength(2000),
                ])
                ->action(function (array $data): void {
                    /** @var Office $record */
                    $record = $this->getRecord();

                    AuditLog::create([
                        'tenant_id' => null,
                        'user_id' => auth()->id(),
                        'action' => (string) ($data['action'] ?? 'office_message_logged'),
                        'model' => Office::class,
                        'model_id' => $record->id,
                        'request' => [
                            'reason' => trim((string) ($data['reason'] ?? '')),
                            'message' => trim((string) ($data['message'] ?? '')),
                        ],
                        'changes' => null,
                        'ip' => request()->ip(),
                        'ua' => (string) request()->userAgent(),
                        'active' => true,
                        'created_at' => now(),
                    ]);
                })
                ->successNotificationTitle('تم حفظ السجل بنجاح'),
        ];
    }

    public function getTitle(): string
    {
        return 'عرض مكتب';
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('بيانات المكتب')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('الصورة')
                            ->circular(),
                        TextEntry::make('id')
                            ->label('ID'),
                        TextEntry::make('name')
                            ->label('الاسم'),
                        TextEntry::make('email')
                            ->label('البريد الإلكتروني'),
                        TextEntry::make('phone')
                            ->label('الهاتف'),
                        TextEntry::make('commercial_reg_no')
                            ->label('رقم السجل التجاري')
                            ->placeholder('—'),
                        TextEntry::make('address')
                            ->label('العنوان')
                            ->placeholder('—')
                            ->columnSpanFull(),
                        IconEntry::make('active')
                            ->label('نشط')
                            ->boolean(),
                        IconEntry::make('blocked')
                            ->label('محظور')
                            ->boolean(),
                        TextEntry::make('last_login_at')
                            ->label('آخر تسجيل دخول')
                            ->dateTime()
                            ->placeholder('—'),
                        TextEntry::make('created_at')
                            ->label('تاريخ الإنشاء')
                            ->dateTime(),
                    ])
                    ->columns(2),

                Section::make('سجل الرسائل')
                    ->schema([
                        RepeatableEntry::make('message_logs')
                            ->label('الرسائل المرسلة للمكتب')
                            ->state(function (Office $record): array {
                                $logs = AuditLog::query()
                                    ->where('model', Office::class)
                                    ->where('model_id', $record->id)
                                    ->whereIn('action', [
                                        'office_stopped_with_reason',
                                        'office_reactivated_with_reason',
                                        'office_message_logged',
                                    ])
                                    ->orderByDesc('created_at')
                                    ->limit(20)
                                    ->get(['action', 'request', 'created_at']);

                                if ($logs->isEmpty()) {
                                    return [[
                                        'created_at' => '-',
                                        'action' => 'لا توجد رسائل مسجلة',
                                        'reason' => '-',
                                        'message' => '-',
                                    ]];
                                }

                                return $logs->map(function ($log): array {
                                    $request = (array) ($log->request ?? []);
                                    $reason = trim((string) ($request['reason'] ?? ''));
                                    $message = trim((string) ($request['message'] ?? ''));
                                    $at = $log->created_at ? $log->created_at->format('Y-m-d H:i') : '-';
                                    $action = match ($log->action) {
                                        'office_reactivated_with_reason' => 'إعادة تفعيل',
                                        'office_message_logged' => 'رسالة',
                                        default => 'إيقاف',
                                    };

                                    return [
                                        'created_at' => $at,
                                        'action' => $action,
                                        'reason' => $reason !== '' ? $reason : '-',
                                        'message' => $message !== '' ? $message : '-',
                                    ];
                                })->values()->all();
                            })
                            ->schema([
                                TextEntry::make('created_at')->label('التاريخ'),
                                TextEntry::make('action')->label('العملية'),
                                TextEntry::make('reason')->label('السبب'),
                                TextEntry::make('message')->label('الرسالة'),
                            ])
                            ->columns(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
