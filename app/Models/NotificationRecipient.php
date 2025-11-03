<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationRecipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_id',
        'recipient_type',
        'recipient_id',
        'resolved_user_id',
        'channel',
        'status',
        'read_at',
        'sent_at',
        'error',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_user_id');
    }
}


