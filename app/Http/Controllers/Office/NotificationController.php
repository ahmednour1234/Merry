<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\NotificationRecipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $office = Auth::guard('office-panel')->user();

        $notifications = NotificationRecipient::on('system')
            ->with('notification')
            ->where('recipient_type', 'office')
            ->where('recipient_id', $office->id)
            ->where('channel', 'inapp')
            ->orderByDesc('id')
            ->paginate(20);

        return view('office.notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $office = Auth::guard('office-panel')->user();

        NotificationRecipient::on('system')
            ->where('id', $id)
            ->where('recipient_type', 'office')
            ->where('recipient_id', $office->id)
            ->update(['status' => 'read', 'read_at' => now()]);

        return back()->with('success', 'تم تحديد الإشعار كمقروء.');
    }

    public function markAllRead()
    {
        $office = Auth::guard('office-panel')->user();

        NotificationRecipient::on('system')
            ->where('recipient_type', 'office')
            ->where('recipient_id', $office->id)
            ->where('channel', 'inapp')
            ->where('status', '!=', 'read')
            ->update(['status' => 'read', 'read_at' => now()]);

        return back()->with('success', 'تم تحديد جميع الإشعارات كمقروءة.');
    }
}
