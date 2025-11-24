<?php
// app/Services/PermissionService.php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Cache\TaggableStore;

class PermissionService
{
    protected function supportsTags(): bool
    {
        return Cache::getStore() instanceof TaggableStore;
    }

    protected function remember(string $key, int $seconds, \Closure $callback)
    {
        // لو فيه Tags: نخزن تحت tag 'permissions'
        if ($this->supportsTags()) {
            return Cache::tags(['permissions'])->remember($key, $seconds, $callback);
        }
        // بدون Tags: نخزن بالمفتاح مباشرة
        return Cache::remember($key, $seconds, $callback);
    }

    protected function forget(string $key): void
    {
        if ($this->supportsTags()) {
            Cache::tags(['permissions'])->forget($key);
            return;
        }
        Cache::forget($key);
    }

    protected function flushPermissionsTag(): void
    {
        if ($this->supportsTags()) {
            Cache::tags(['permissions'])->flush();
        } else {
            // Fallback بسيط: امسح مفاتيح مستخدمين معروفين (أو تجاهل لو مش محتاج)
            // تقدر تستبدل ده باستراتيجية أنظف (prefix) أو تسيبه فاضي.
        }
    }

    public function userPermissions(User $user): Collection
    {
        $cacheKey = "user:{$user->id}:perms";

        try {
            return $this->remember($cacheKey, 300, function () use ($user) {
                try {
                    $direct = $user->permissions()->where('active', true)->pluck('slug');
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('PermissionService: Failed to get direct permissions', [
                        'user_id' => $user->id,
                        'error' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                    ]);
                    $direct = collect([]);
                }

                try {
                    $viaRoles = Permission::on('system')
                        ->where('active', true)
                        ->whereIn('id', function ($q) use ($user) {
                            $q->select('permission_id')->from('permission_role')
                              ->whereIn('role_id', $user->roles()->pluck('roles.id'));
                        })->pluck('slug');
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('PermissionService: Failed to get role permissions', [
                        'user_id' => $user->id,
                        'error' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                    ]);
                    $viaRoles = collect([]);
                }

                return $direct->merge($viaRoles)->unique()->values();
            });
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('PermissionService: Cache or query failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            // Return empty collection on error instead of throwing
            return collect([]);
        }
    }

    public function userHas(User $user, string $permission): bool
    {
        try {
            return $this->userPermissions($user)->contains($permission);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('PermissionService: userHas check failed', [
                'user_id' => $user->id,
                'permission' => $permission,
                'error' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            // Return false on error instead of throwing
            return false;
        }
    }

    public function forgetUserCache(int $userId): void
    {
        $this->forget("user:{$userId}:perms");
    }

    public function forgetAll(): void
    {
        $this->flushPermissionsTag();
    }

    public function syncRolePermissions(Role $role, array $permIdsOrSlugs): void
    {
        $ids = Permission::on('system')->where(function ($q) use ($permIdsOrSlugs) {
            $q->whereIn('id', $permIdsOrSlugs)->orWhereIn('slug', $permIdsOrSlugs);
        })->pluck('id')->toArray();

        $role->permissions()->sync($ids);

        // امسح كاش الصلاحيات (حسب الإمكان)
        $this->forgetAll();
    }
}
