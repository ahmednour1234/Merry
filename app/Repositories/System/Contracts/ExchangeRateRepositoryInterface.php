<?php

namespace App\Repositories\System\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\ExchangeRate;

interface ExchangeRateRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    public function all(): Collection;
    public function upsert(string $base, string $quote, float $rate, ?string $at = null, bool $active = true): ExchangeRate;
    public function byPair(string $base, string $quote): ?ExchangeRate;
    public function toggle(string $base, string $quote, bool $active): ?ExchangeRate;
}
