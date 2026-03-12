<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfficeSubscriptionLog extends Model
{
    protected $connection = 'system';
    protected $table = 'office_subscription_logs';

    protected $fillable = ['office_subscription_id', 'action', 'payload', 'user_id'];

    protected $casts = ['payload' => 'array'];

    public function officeSubscription(): BelongsTo
    {
        return $this->belongsTo(OfficeSubscription::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function log(int $subscriptionId, string $action, ?array $payload = null, ?int $userId = null): self
    {
        return self::create([
            'office_subscription_id' => $subscriptionId,
            'action' => $action,
            'payload' => $payload,
            'user_id' => $userId ?? auth()?->id(),
        ]);
    }
}
