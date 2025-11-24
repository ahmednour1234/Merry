<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard'     => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | guards المتاحة في السيستم
    |
    */

    'guards' => [

        // للوحة التحكم / الموقع العادي
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],

        // ✅ Guard عام باسم sanctum عشان middleware `auth:sanctum`
        'sanctum' => [
            'driver'   => 'sanctum',
            'provider' => 'users',
        ],

        // مكتب / موظفين (لو عندك موديل Office)
        'office' => [
            'driver'   => 'sanctum',
            'provider' => 'offices',
        ],

        // العميل النهائي (End User) – موبايل/فرونت
        'enduser' => [
            'driver'   => 'sanctum',
            'provider' => 'endusers',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => env('AUTH_MODEL', App\Models\User::class),
        ],

        'offices' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Office::class,
        ],

        'endusers' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Identity\EndUser::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire'   => 60,
            'throttle' => 60,
        ],

        'endusers' => [
            'provider' => 'endusers',
            'table'    => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire'   => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

    // كود ديفولت للاستعادة من غير SMS في بيئة الديف
    'reset_dev_code' => env('OFFICE_RESET_DEV_CODE', '123456'),
];
