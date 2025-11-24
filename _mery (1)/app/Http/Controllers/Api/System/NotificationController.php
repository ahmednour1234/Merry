<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Controller;
use App\Models\NotificationRecipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Notifications
 *
 * Endpoints for listing and marking in-app notifications as read.
 * @authenticated
 */
class NotificationController extends Controller
{
    /**
     * List notifications
     *
     * Paginated list of in-app notifications for the current principal (system user or office).
     *
     * @queryParam page integer The page number. Example: 1
     */
    public function index(Request $request)
    {
        [$type, $id] = $this->currentPrincipal();

        $query = NotificationRecipient::query()
            ->with('notification')
            ->where('channel', 'inapp');

        if ($type === 'user') {
            $query->where('resolved_user_id', $id);
        } else {
            $query->where('recipient_type', 'office')->where('recipient_id', $id);
        }

        $items = $query->orderByDesc('id')->paginate(20);
        return response()->json($items);
    }

    /**
     * Mark a notification as read
     *
     * @urlParam id integer required The notification recipient ID. Example: 123
     */
    public function markRead(Request $request, int $id)
    {
        [$type, $principalId] = $this->currentPrincipal();

        $rec = NotificationRecipient::query()->findOrFail($id);

        if ($type === 'user' && $rec->resolved_user_id !== $principalId) {
            abort(403);
        }
        if ($type === 'office' && !($rec->recipient_type === 'office' && (int)$rec->recipient_id === (int)$principalId)) {
            abort(403);
        }

        $rec->update(['status' => 'read', 'read_at' => now()]);
        return response()->json(['ok' => true]);
    }

    /**
     * Mark all as read
     */
    public function markAllRead(Request $request)
    {
        [$type, $id] = $this->currentPrincipal();

        $query = NotificationRecipient::query()->where('channel', 'inapp');
        if ($type === 'user') {
            $query->where('resolved_user_id', $id);
        } else {
            $query->where('recipient_type', 'office')->where('recipient_id', $id);
        }
        $query->update(['status' => 'read', 'read_at' => now()]);
        return response()->json(['ok' => true]);
    }

    private function currentPrincipal(): array
    {
        if (Auth::guard('office')->check()) {
            return ['office', Auth::guard('office')->id()];
        }
        return ['user', Auth::id()];
    }
}


