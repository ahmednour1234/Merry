<?php

namespace App\Filament\Office\Components;

use App\Models\NotificationRecipient;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    public function render(): View
    {
        $office = Auth::guard('office-panel')->user();
        $unreadCount = 0;

        if ($office) {
            $unreadCount = NotificationRecipient::on('system')
                ->where('channel', 'inapp')
                ->where('recipient_type', 'office')
                ->where('recipient_id', $office->id)
                ->where('status', 'sent')
                ->whereNull('read_at')
                ->count();
        }

        return view('filament.office.components.notification-bell', [
            'unreadCount' => $unreadCount,
        ]);
    }
}
