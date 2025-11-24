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
	 * اعرض كل الإعدادات لمدى معين (scope) أو لكل المدى
	 */
	public function all(?string $scope = 'global'): array
	{
		$q = DB::connection($this->conn)->table($this->table);
		if ($scope !== null) {
			$q->where('scope', $scope);
		}
		$rows = $q->orderBy('scope')->orderBy('key')->get();

		$result = [];
		foreach ($rows as $row) {
			$value = $row->value;
			if (property_exists($row, 'type') && $row->type === 'json') {
				$decoded = json_decode((string)$row->value, true);
				$value = $decoded ?? $row->value;
			}
			$result[] = [
				'scope' => $row->scope,
				'key' => $row->key,
				'value' => $value,
				'type' => property_exists($row, 'type') ? $row->type : null,
			];
		}
		return $result;
	}

	/**
	 * حفظ/تحديث إعداد لمسار محدد
	 * سيحدّث الكاش حتى يظهر فوراً
	 */
	public function put(string $key, mixed $value, string $scope = 'global', ?string $type = null): bool
	{
		$detectedType = $type ?: (is_array($value) || is_object($value) ? 'json' : 'string');
		$storeValue = $detectedType === 'json' ? json_encode($value, JSON_UNESCAPED_UNICODE) : (string)$value;

		try {
			DB::connection($this->conn)->table($this->table)->updateOrInsert(
				['scope' => $scope, 'key' => $key],
				['value' => $storeValue, 'type' => $detectedType, 'updated_at' => now(), 'created_at' => now()]
			);

			// drop cache for this key
			$cacheKey = "settings:{$scope}:{$key}";
			Cache::forget($cacheKey);

			return true;
		} catch (\Throwable $e) {
			\Illuminate\Support\Facades\Log::warning('SystemSettings: put failed', [
				'key' => $key,
				'scope' => $scope,
				'error' => $e->getMessage(),
			]);
			return false;
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
