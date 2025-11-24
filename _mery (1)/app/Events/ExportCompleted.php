<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;

class ExportCompleted
{
    use Dispatchable, InteractsWithSockets;

    public function __construct(
        public int $userId,
        public string $fileName,
        public ?string $downloadLink = null,
        public ?string $expiresAt = null,
    ) {}
}


