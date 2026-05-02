<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FcmService
{
    private string $serverKey;
    private string $endpoint = 'https://fcm.googleapis.com/fcm/send';

    public function __construct()
    {
        $this->serverKey = (string) config('services.fcm.server_key', '');
    }

    /**
     * Send FCM push notification to one or more device tokens.
     *
     * @param string   $title  Notification title
     * @param string   $body   Notification body
     * @param string[] $tokens Array of FCM device tokens
     * @param array    $data   Extra data payload
     */
    public function sendToTokens(string $title, string $body, array $tokens, array $data = []): void
    {
        if (empty($tokens) || empty($this->serverKey)) {
            return;
        }

        // FCM allows max 1000 registration IDs per request
        foreach (array_chunk($tokens, 1000) as $chunk) {
            try {
                Http::withHeaders([
                    'Authorization' => 'key=' . $this->serverKey,
                    'Content-Type'  => 'application/json',
                ])->post($this->endpoint, [
                    'registration_ids' => $chunk,
                    'notification' => [
                        'title' => $title,
                        'body'  => $body,
                        'sound' => 'default',
                    ],
                    'data'     => $data,
                    'priority' => 'high',
                ]);
            } catch (\Throwable $e) {
                Log::error('FCM send failed', [
                    'error'  => $e->getMessage(),
                    'tokens' => count($chunk),
                ]);
            }
        }
    }
}
