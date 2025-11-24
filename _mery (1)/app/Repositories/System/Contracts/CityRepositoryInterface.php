<?php

namespace App\Repositories\System\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\City;

interface CityRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function store(array $data): City;
    public function update(int $id, array $data): ?City;
    public function destroy(int $id): bool;
    public function toggle(int $id, bool $active): ?City;
}
