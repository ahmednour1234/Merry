<?php

namespace App\Repositories\System\Contracts;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function store(array $data): Category;
    public function update(int $id, array $data): ?Category;
    public function destroy(int $id): bool;
    public function toggle(int $id, bool $active): ?Category;

    public function upsertTranslation(int $id, string $lang, string $name): bool;
}
