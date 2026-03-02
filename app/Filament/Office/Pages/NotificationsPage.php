<?php

namespace App\Filament\Office\Pages;

use App\Models\NotificationRecipient;
use BackedEnum;
use Filament\Actions\Action as FilamentAction;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class NotificationsPage extends Page implements HasTable
{
    use InteractsWithTable;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bell-alert';

    protected string $view = 'filament.office.pages.notifications';

    protected static ?string $navigationLabel = 'الإشعارات';

    protected static ?string $title = 'الإشعارات';

    public static function getRoutes(): \Closure
    {
        return function () {
            Route::get('/notifications', static::class)->name(static::getSlug());
            Route::post('/notifications/{id}/mark-read', [static::class, 'markAsRead'])->name('notifications.mark-read');
            Route::post('/notifications/read-all', [static::class, 'markAllRead'])->name('notifications.read-all');
        };
    }

    public function markAsRead($id)
    {
        $office = Auth::guard('office-panel')->user();
        if (!$office) {
            abort(403);
        }

        $recipient = NotificationRecipient::on('system')
            ->where('id', $id)
            ->where('recipient_type', 'office')
            ->where('recipient_id', $office->id)
            ->firstOrFail();

        $recipient->update([
            'status' => 'read',
            'read_at' => now(),
        ]);

        return redirect()->back();
    }

    public function markAllRead()
    {
        $office = Auth::guard('office-panel')->user();
        if (!$office) {
            abort(403);
        }

        NotificationRecipient::on('system')
            ->where('channel', 'inapp')
            ->where('recipient_type', 'office')
            ->where('recipient_id', $office->id)
            ->where('status', 'sent')
            ->whereNull('read_at')
            ->update([
                'status' => 'read',
                'read_at' => now(),
            ]);

        return redirect()->back();
    }

    public function table(Table $table): Table
    {
        $office = Auth::guard('office-panel')->user();

        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->with('notification')
                ->where('channel', 'inapp')
                ->where('recipient_type', 'office')
                ->where('recipient_id', $office->id)
                ->orderByDesc('id')
            )
            ->columns([
                Tables\Columns\TextColumn::make('notification.title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('notification.body')
                    ->label('المحتوى')
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\IconColumn::make('status')
                    ->label('الحالة')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->getStateUsing(fn ($record) => $record->status === 'read'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('التاريخ'),
            ])
            ->actions([
                FilamentAction::make('mark_read')
                    ->label('تحديد كمقروء')
                    ->icon('heroicon-o-check')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'read',
                            'read_at' => now(),
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('تم تحديد الإشعار كمقروء')
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->status !== 'read'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getUrl(array $parameters = [], bool $isAbsolute = true, ?string $panel = null, ?\Illuminate\Database\Eloquent\Model $tenant = null): string
    {
        $panel = $panel ?? \Filament\Facades\Filament::getPanel('office');
        return $panel->getUrl() . '/notifications';
    }
}
