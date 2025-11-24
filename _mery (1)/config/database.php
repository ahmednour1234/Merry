<?php

use Illuminate\Support\Str;

return [

    'default' => env('DB_CONNECTION', 'system'),

  'connections' => [
    'system' => [
        'driver' => 'mysql',
        'host' => env('DB_SYSTEM_HOST','127.0.0.1'),
        'port' => env('DB_SYSTEM_PORT',3306),
        'database' => env('DB_SYSTEM_DATABASE','mery_system'),
        'username' => env('DB_SYSTEM_USERNAME','root'),
        'password' => env('DB_SYSTEM_PASSWORD',''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci', // <-- هنا
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ],

    'identity' => [
        'driver' => 'mysql',
        'host' => env('DB_IDENTITY_HOST','127.0.0.1'),
        'port' => env('DB_IDENTITY_PORT',3306),
        'database' => env('DB_IDENTITY_DATABASE','mery_identity'),
        'username' => env('DB_IDENTITY_USERNAME','root'),
        'password' => env('DB_IDENTITY_PASSWORD',''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci', // <-- وهنا
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ],
],

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    'redis' => [
        'client' => env('REDIS_CLIENT', 'phpredis'),
        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-database-'),
            'persistent' => env('REDIS_PERSISTENT', false),
        ],
        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],
        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],
    ],
];
