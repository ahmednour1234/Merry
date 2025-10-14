<?php

namespace App\Repositories\System;

use App\Models\User;
use App\Repositories\System\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = User::on('system')->with(['roles'])->orderByDesc('created_at');

        if (!empty($filters['name']))   $q->where('name', 'like', '%'.$filters['name'].'%');
        if (!empty($filters['email']))  $q->where('email', 'like', '%'.$filters['email'].'%');
        if (isset($filters['active']))  $q->where('active', (bool)$filters['active']);
        if (!empty($filters['guard']))  $q->where('guard', $filters['guard']);
        if (!empty($filters['role'])) {
            $role = $filters['role'];
            $q->whereHas('roles', function($w) use ($role){
                $w->where('slug', $role)->orWhere('name', $role)->orWhere('id', $role);
            });
        }
        if (!empty($filters['from']))   $q->where('created_at', '>=', $filters['from']);
        if (!empty($filters['to']))     $q->where('created_at', '<=', $filters['to']);

        return $q->paginate($perPage)->appends(request()->query());
    }

    public function store(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::on('system')->create($data);
        if (!empty($data['roles'])) {
            $ids = \App\Models\Role::on('system')->whereIn('id', (array)$data['roles'])->pluck('id')->toArray();
            $user->roles()->sync($ids);
        }
        return $user->fresh(['roles']);
    }

    public function update(int $id, array $data): ?User
    {
        $user = User::on('system')->find($id);
        if (!$user) return null;

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->fill($data)->save();

        if (array_key_exists('roles', $data)) {
            $ids = \App\Models\Role::on('system')->whereIn('id', (array)$data['roles'])->pluck('id')->toArray();
            $user->roles()->sync($ids);
        }

        return $user->fresh(['roles']);
    }

    public function destroy(int $id): bool
    {
        $user = User::on('system')->find($id);
        return $user ? (bool)$user->delete() : false;
    }

    public function toggle(int $id, bool $active): ?User
    {
        $user = User::on('system')->find($id);
        if (!$user) return null;
        $user->active = $active;
        $user->save();
        return $user;
    }

    public function syncRoles(int $id, array $roles): ?User
    {
        $user = User::on('system')->find($id);
        if (!$user) return null;
        $ids = \App\Models\Role::on('system')->whereIn('id', $roles)->pluck('id')->toArray();
        $user->roles()->sync($ids);
        return $user->fresh(['roles']);
    }
}
