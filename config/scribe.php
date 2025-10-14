<?php

use Knuckles\Scribe\Extracting\Strategies;
use Knuckles\Scribe\Config\Defaults;
use Knuckles\Scribe\Config\AuthIn;
use function Knuckles\Scribe\Config\{removeStrategies, configureStrategy};

// Only the most common configs are shown. See the https://scribe.knuckles.wtf/laravel/reference/config for all.

return [
    'title' => env('APP_NAME', 'Mery API'),
    'description' => 'Auto-generated API docs and Postman collection.',
    'base_url' => env('SCRIBE_BASE_URL', env('APP_URL', 'http://localhost')),

    // لو عندك توكن أو هيدر ثابت حطه هنا
    'auth' => [
        'enabled' => false, // true لو عندك Auth
        'in' => 'bearer',   // bearer|header|query|body
        'name' => 'Authorization',
        'use_value' => 'Bearer {YOUR_TOKEN}',
    ],

    // هيدر افتراضي (مثلاً اللغة)
    'postman' => [
        'enabled' => true,
        'overrides' => [
            'info' => [
                'name' => env('APP_NAME', 'Mery') . ' – Postman',
            ],
            'variable' => [
                ['key' => 'baseUrl', 'value' => env('APP_URL', 'http://localhost')],
            ],
            'item' => [],
        ],
        'headers' => [
            ['key' => 'Accept', 'value' => 'application/json'],
            ['key' => 'X-Locale', 'value' => 'ar'], // اختياري
        ],
    ],

    // مكان الإخراج
    'output' => [
        'path' => 'public/docs', // هتلاقي الملفات هنا
    ],
];
