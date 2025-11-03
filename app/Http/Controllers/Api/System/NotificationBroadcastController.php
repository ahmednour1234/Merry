<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Controller;
use App\Services\Notifications\NotificationService;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Notifications
 *
 * Broadcast notifications to admins or selected offices.
 * @authenticated
 */
class NotificationBroadcastController extends Controller
{
    public function __construct(private NotificationService $service)
    {
    }

    /**
     * Broadcast a notification
     *
     * Create and send a notification to admins or a list of office IDs.
     *
     * @bodyParam title string required The notification title. Example: System update tonight
     * @bodyParam body string The body text. Example: We will update the system at 1 AM UTC.
     * @bodyParam target string required Target audience. One of: admins, offices. Example: admins
     * @bodyParam office_ids array Office IDs when target=offices. Example: [1,2,3]
     * @bodyParam channels array Channels to send on. Example: ["inapp","email"]
     */
    public function store(Request $request)
    {
        if (!config('features.notifications_broadcast')) {
            abort(403, 'Broadcasting notifications is disabled');
        }
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'target' => 'required|string|in:admins,offices',
            'office_ids' => 'array',
            'office_ids.*' => 'integer',
            'channels' => 'array',
            'channels.*' => 'in:inapp,email',
        ]);

        // Authorization placeholder: require admin
        if (!Auth::check()) {
            abort(401);
        }

        $notification = $this->service->createNotification([
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'type' => 'broadcast',
            'created_by' => Auth::id(),
        ]);

        $channels = $data['channels'] ?? ['inapp','email'];
        $sent = 0;
        if ($data['target'] === 'admins') {
            $sent = $this->service->notifyAdmins($notification, $channels);
        } else {
            $officeIds = $data['office_ids'] ?? [];
            $sent = $this->service->notifyOffices($notification, $officeIds, $channels);
        }

        AuditLog::create([
            'tenant_id' => null,
            'user_id' => Auth::id(),
            'action' => 'notification.broadcast',
            'model' => 'notification',
            'model_id' => $notification->id,
            'request' => $request->all(),
            'changes' => ['recipients' => $sent],
            'ip' => $request->ip(),
            'ua' => $request->userAgent(),
            'active' => true,
            'created_at' => now(),
        ]);

        return response()->json(['notification_id' => $notification->id, 'recipients' => $sent]);
    }
}


