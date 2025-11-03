<?php

namespace App\Services\Notifications;

use App\Models\Notification;
use App\Models\NotificationRecipient;
use App\Models\NotificationTemplate;
use App\Models\Office;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function createNotification(array $payload): Notification
    {
        return Notification::create([
            'type' => $payload['type'] ?? null,
            'title' => $payload['title'],
            'body' => $payload['body'] ?? null,
            'data' => $payload['data'] ?? null,
            'priority' => $payload['priority'] ?? 'normal',
            'created_by' => $payload['created_by'] ?? null,
        ]);
    }

    /**
     * Notify all users with role 'admin'.
     */
    public function notifyAdmins(Notification $notification, array $channels = ['inapp','email']): int
    {
        $adminUsers = User::query()
            ->whereHas('roles', function ($q) {
                $q->where('slug', 'admin');
            })
            ->where('active', true)
            ->get(['id','email','name']);

        $adminRoleId = Role::query()->where('slug', 'admin')->value('id');
        return $this->deliverToUsers($notification, $adminUsers, $channels, 'role', $adminRoleId);
    }

    /**
     * Notify specific offices by IDs.
     */
    public function notifyOffices(Notification $notification, array $officeIds, array $channels = ['inapp','email']): int
    {
        $offices = Office::query()
            ->whereIn('id', $officeIds)
            ->where('active', true)
            ->get(['id','email','name']);

        $count = 0;
        foreach ($offices as $office) {
            foreach ($channels as $channel) {
                NotificationRecipient::create([
                    'notification_id' => $notification->id,
                    'recipient_type' => 'office',
                    'recipient_id' => $office->id,
                    'resolved_user_id' => null,
                    'channel' => $channel,
                    'status' => $channel === 'inapp' ? 'sent' : 'queued',
                ]);

                if ($channel === 'email' && $office->email) {
                    $this->queueEmail($office->email, $notification);
                }
                $count++;
            }
        }
        return $count;
    }

    /**
     * Deliver to a collection of users.
     */
    public function deliverToUsers(Notification $notification, Collection $users, array $channels, string $recipientType = 'user', $recipientKey = null): int
    {
        $count = 0;
        $seen = [];
        foreach ($users as $user) {
            $key = $user->id.'|'.implode(',', $channels);
            if (isset($seen[$key])) {
                continue;
            }
            $seen[$key] = true;

            foreach ($channels as $channel) {
                NotificationRecipient::create([
                    'notification_id' => $notification->id,
                    'recipient_type' => $recipientType,
                    'recipient_id' => $recipientKey,
                    'resolved_user_id' => $user->id,
                    'channel' => $channel,
                    'status' => $channel === 'inapp' ? 'sent' : 'queued',
                ]);

                if ($channel === 'email' && $user->email) {
                    $this->queueEmail($user->email, $notification);
                }
                $count++;
            }
        }
        return $count;
    }

    protected function queueEmail(string $email, Notification $notification): void
    {
        Mail::to($email)->queue(new \App\Mail\GenericNotificationMail($notification));
    }
}


