<?php

namespace App\Repositories\System\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\User;

interface UserRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function store(array $data): User;
    public function update(int $id, array $data): ?User;
    public function destroy(int $id): bool; // soft delete
    public function toggle(int $id, bool $active): ?User;
    public function syncRoles(int $id, array $roles): ?User;
}
