<?php

use Knuckles\Scribe\Config\Defaults;
use Knuckles\Scribe\Config\AuthIn;
use Knuckles\Scribe\Extracting\Strategies as ExtractingStrategies;
use function Knuckles\Scribe\Config\removeStrategies;

// Only the most common configs are shown. See the https://scribe.knuckles.wtf/laravel/reference/config for all.

// ... existing code ...

return [
    'title' => env('APP_NAME', 'Merry API'),
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
                'name' => env('APP_NAME', 'Merry') . ' – Postman',
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

    // Disable wrapping response calls in database transactions (we're not running them)
    'database_connections_to_transact' => [],

    // Use default strategies, but skip automatic response calls to avoid hitting unavailable services/dbs
    'strategies' => [
        'metadata' => Defaults::METADATA_STRATEGIES,
        'headers' => Defaults::HEADERS_STRATEGIES,
        'urlParameters' => Defaults::URL_PARAMETERS_STRATEGIES,
        'queryParameters' => Defaults::QUERY_PARAMETERS_STRATEGIES,
        'bodyParameters' => Defaults::BODY_PARAMETERS_STRATEGIES,
        'responses' => removeStrategies(Defaults::RESPONSES_STRATEGIES, [
            ExtractingStrategies\Responses\ResponseCalls::class,
        ]),
        'responseFields' => Defaults::RESPONSE_FIELDS_STRATEGIES,
    ],
];
