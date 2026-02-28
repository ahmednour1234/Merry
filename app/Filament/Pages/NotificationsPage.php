<?php

namespace App\Filament\Pages;

use App\Models\NotificationRecipient;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

class NotificationsPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bell';

    protected string $view = 'filament.pages.notifications';

    protected static ?string $navigationLabel = 'الإشعارات';

    protected static ?string $title = 'الإشعارات';

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    public static function getRoutes(): \Closure
    {
        return function () {
            Route::get('/notifications', static::class)->name(static::getSlug());
            Route::post('/notifications/{id}/mark-read', [static::class, 'markAsRead'])->name('notifications.mark-read');
        };
    }

    public function markAsRead($id)
    {
        $user = auth()->user();
        if (!$user) {
            abort(403);
        }

        $recipient = NotificationRecipient::on('system')
            ->where('id', $id)
            ->where('resolved_user_id', $user->id)
            ->firstOrFail();

        $recipient->update([
            'status' => 'read',
            'read_at' => now(),
        ]);

        return redirect()->back();
    }

    public function getUnreadCount(): int
    {
        $user = auth()->user();
        if (!$user) {
            return 0;
        }

        return NotificationRecipient::on('system')
            ->where('channel', 'inapp')
            ->where('resolved_user_id', $user->id)
            ->where('status', 'sent')
            ->whereNull('read_at')
            ->count();
    }
}
