<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SystemSettings
{
    protected string $conn = 'system';
    protected string $table = 'system_settings';
    protected int $ttl = 300; // 5 دقائق

    /**
     * احصل على قيمة إعداد بالمفتاح (scope=global افتراضياً)
     * scope أمثلة: global | module:{code} | tenant:{id}
     */
    public function get(string $key, mixed $default = null, string $scope = 'global'): mixed
    {
        $cacheKey = "settings:{$scope}:{$key}";

        try {
            return Cache::remember($cacheKey, $this->ttl, function () use ($key, $scope, $default) {
                try {
                    $row = DB::connection($this->conn)
                        ->table($this->table)
                        ->where('scope', $scope)
                        ->where('key', $key)
                        ->first();

                    if (!$row) {
                        return $default;
                    }

                    // type=json افتراضياً في جدولك
                    if (property_exists($row, 'type') && $row->type === 'json') {
                        $val = json_decode((string) $row->value, true);
                        return $val ?? $default;
                    }

                    return $row->value ?? $default;
                } catch (\Throwable $e) {
                    // If database query fails, return default
                    \Illuminate\Support\Facades\Log::warning('SystemSettings: Database query failed', [
                        'key' => $key,
                        'scope' => $scope,
                        'error' => $e->getMessage(),
                    ]);
                    return $default;
                }
            });
        } catch (\Throwable $e) {
            // If cache fails, return default
            \Illuminate\Support\Facades\Log::warning('SystemSettings: Cache operation failed', [
                'key' => $key,
                'error' => $e->getMessage(),
            ]);
            return $default;
        }
    }

    /**
     * اللغة الافتراضية للنظام: system_settings(scope=global, key=app.locale)
     */
    public function defaultLocale(string $fallback = 'en'): string
    {
        try {
            $val = $this->get('app.locale', $fallback, 'global');
            // لو رجع مصفوفة أو قيمة مركّبة، خذها كسلسلة
            if (is_array($val)) {
                return (string) ($val['code'] ?? $fallback);
            }
            return (string) ($val ?: $fallback);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('SystemSettings: defaultLocale failed', [
                'error' => $e->getMessage(),
            ]);
            return $fallback;
        }
    }
}
