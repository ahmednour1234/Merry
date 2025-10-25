<?php

namespace App\Repositories\System\Contracts;

use App\Models\Nationality;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface NationalityRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function all(array $filters = []): Collection;
    public function store(array $data): Nationality;
    public function update(int $id, array $data): ?Nationality;
    public function destroy(int $id): bool;
    public function toggle(int $id, bool $active): ?Nationality;

    public function upsertTranslation(int $id, string $lang, string $name): bool;
}
