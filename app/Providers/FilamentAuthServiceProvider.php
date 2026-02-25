<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class FilamentAuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Auth::provider('filament-users', function ($app, array $config) {
            return new class($config['model']) extends \Illuminate\Auth\EloquentUserProvider
            {
                public function __construct($model)
                {
                    parent::__construct(app('hash'), $model);
                }

                public function retrieveByCredentials(array $credentials)
                {
                    if (empty($credentials) || 
                        (count($credentials) === 1 && array_key_exists('password', $credentials))) {
                        return null;
                    }

                    $query = User::on('system')
                        ->where('guard', 'filament')
                        ->where('active', true);

                    foreach ($credentials as $key => $value) {
                        if (!str_contains($key, 'password')) {
                            $query->where($key, $value);
                        }
                    }

                    return $query->first();
                }
            };
        });
    }
}
