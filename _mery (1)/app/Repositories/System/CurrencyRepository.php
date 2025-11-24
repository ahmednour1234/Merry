<?php

namespace App\Repositories\System;

use App\Models\Currency;
use App\Repositories\System\Contracts\CurrencyRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Currency::on('system')->orderBy('code')->paginate($perPage)->appends(request()->query());
    }

    public function all(): Collection
    {
        return Currency::on('system')->orderBy('code')->get();
    }

    public function store(array $data): Currency
    {
        return Currency::on('system')->updateOrCreate(
            ['code' => $data['code']],
            [
                'name'    => $data['name'] ?? $data['code'],
                'symbol'  => $data['symbol'] ?? null,
                'decimal' => $data['decimal'] ?? 2,
                'active'  => (bool)($data['active'] ?? true),
            ]
        );
    }

    public function update(string $code, array $data): ?Currency
    {
        $row = Currency::on('system')->find($code);
        if (!$row) return null;
        $row->fill($data);
        $row->save();
        return $row;
    }

    public function destroy(string $code): bool
    {
        $row = Currency::on('system')->find($code);
        return $row ? (bool)$row->delete() : false;
    }

    public function toggle(string $code, bool $active): ?Currency
    {
        $row = Currency::on('system')->find($code);
        if (!$row) return null;
        $row->active = $active;
        $row->save();
        return $row;
    }
}
