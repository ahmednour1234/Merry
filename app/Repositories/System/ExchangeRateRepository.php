<?php

namespace App\Repositories\System;

use App\Models\ExchangeRate;
use App\Repositories\System\Contracts\ExchangeRateRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class ExchangeRateRepository implements ExchangeRateRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return ExchangeRate::on('system')->orderBy('base')->orderBy('quote')->paginate($perPage)->appends(request()->query());
    }

    public function all(): Collection
    {
        return ExchangeRate::on('system')->orderBy('base')->orderBy('quote')->get();
    }

    public function upsert(string $base, string $quote, float $rate, ?string $at = null, bool $active = true): ExchangeRate
    {
        return ExchangeRate::on('system')->updateOrCreate(
            ['base' => strtoupper($base), 'quote' => strtoupper($quote)],
            [
                'rate'       => $rate,
                'fetched_at' => $at ? Carbon::parse($at) : now(),
                'active'     => $active,
            ]
        );
    }

    public function byPair(string $base, string $quote): ?ExchangeRate
    {
        return ExchangeRate::on('system')->where('base', strtoupper($base))->where('quote', strtoupper($quote))->first();
    }

    public function toggle(string $base, string $quote, bool $active): ?ExchangeRate
    {
        $row = $this->byPair($base, $quote);
        if (!$row) return null;
        $row->active = $active;
        $row->save();
        return $row;
    }
}
