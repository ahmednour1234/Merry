<?php

use Knuckles\Scribe\Extracting\Strategies;
use Knuckles\Scribe\Config\Defaults;
use Knuckles\Scribe\Config\AuthIn;
use function Knuckles\Scribe\Config\{removeStrategies, configureStrategy};

// Only the most common configs are shown. See the https://scribe.knuckles.wtf/laravel/reference/config for all.

// ... existing code ...

return [
    'title' => env('APP_NAME', 'Mery API'),
    'description' => 'Auto-generated API docs and Postman collection.',
    'base_url' => env('SCRIBE_BASE_URL', env('APP_URL', 'http://localhost')),

    // Enable auth for Postman collection
    'auth' => [
        'enabled' => true, // Set to true to include auth in generated collection
        'in' => 'bearer',  // Bearer token
        'name' => 'Authorization',
        'use_value' => 'Bearer {{token}}',  // Use Postman variable for token
    ],

    // Postman settings
    'postman' => [
        'enabled' => true,
        'overrides' => [
            'info' => [
                'name' => env('APP_NAME', 'Mery') . ' – Postman',
            ],
            'variable' => [
                ['key' => 'baseUrl', 'value' => env('SCRIBE_BASE_URL', env('APP_URL', 'http://localhost'))],
                ['key' => 'token', 'value' => '', 'description' => 'Set your API token here'],  // Add token variable
            ],
            'item' => [],
        ],
        'headers' => [
            ['key' => 'Accept', 'value' => 'application/json'],
            ['key' => 'X-Locale', 'value' => 'ar'],
        ],
    ],

    // Output path remains the same
    'output' => [
        'path' => 'public/docs',
    ],
];
