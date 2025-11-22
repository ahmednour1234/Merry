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

        return $this->remember($cacheKey, 300, function () use ($user) {
            // Resolve the user's latest role from role_user (by highest id as a reliable proxy)
            $latestRoleId = \Illuminate\Support\Facades\DB::connection('system')
                ->table('role_user')
                ->where('user_id', $user->id)
                ->orderByDesc('id') // latest assignment
                ->value('role_id');

            if (!$latestRoleId) {
                return collect();
            }

            // Fetch permissions for that single role via permission_role → permissions
            $permissionSlugs = Permission::on('system')
                ->where('active', true)
                ->whereIn('id', function ($q) use ($latestRoleId) {
                    $q->select('permission_id')
                      ->from('permission_role')
                      ->where('role_id', $latestRoleId);
                })
                ->pluck('slug');

            return $permissionSlugs->unique()->values();
        });
    }

    public function userHas(User $user, string $permission): bool
    {
        return $this->userPermissions($user)->contains($permission);
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
