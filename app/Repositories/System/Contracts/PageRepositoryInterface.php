<?php

namespace App\Repositories\System\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Page;

interface PageRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function store(array $data): Page;
    public function update(int $id, array $data): ?Page;
    public function destroy(int $id): bool;
    public function toggle(int $id, bool $active): ?Page;
}


