<?php

namespace App\Filament\Components;

use App\Models\NotificationRecipient;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotificationBell extends Component
{
    public function render(): View
    {
        $user = auth()->user();
        $unreadCount = 0;

        if ($user) {
            $unreadCount = NotificationRecipient::on('system')
                ->where('channel', 'inapp')
                ->where('resolved_user_id', $user->id)
                ->where('status', 'sent')
                ->whereNull('read_at')
                ->count();
        }

        return view('filament.components.notification-bell', [
            'unreadCount' => $unreadCount,
        ]);
    }
}
