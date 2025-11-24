<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;

class OfficeRegistered
{
    use Dispatchable, InteractsWithSockets;

    public function __construct(public int $officeId)
    {
    }
}



