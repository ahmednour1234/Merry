<?php

namespace App\Repositories\System\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Currency;

interface CurrencyRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    public function all(): Collection;
    public function store(array $data): Currency;         // upsert by code
    public function update(string $code, array $data): ?Currency;
    public function destroy(string $code): bool;          // soft delete
    public function toggle(string $code, bool $active): ?Currency;
}
