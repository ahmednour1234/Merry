<?php

namespace App\Repositories\System;

use App\Models\SystemLanguage;
use App\Repositories\System\Contracts\SystemLanguageRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SystemLanguageRepository implements SystemLanguageRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return SystemLanguage::on('system')
            ->orderBy('rtl')
            ->orderBy('code')
            ->paginate($perPage)
            ->appends(request()->query());
    }

    public function all(): Collection
    {
        return SystemLanguage::on('system')
            ->orderBy('rtl')
            ->orderBy('code')
            ->get();
    }

    public function store(array $data)
    {
        return SystemLanguage::on('system')->updateOrCreate(
            ['code' => $data['code']],
            [
                'name'        => $data['name'] ?? $data['code'],
                'native_name' => $data['native_name'] ?? ($data['name'] ?? $data['code']),
                'rtl'         => (bool) ($data['rtl'] ?? false),
                'status'      => $data['status'] ?? 'active',
                'meta'        => $data['meta'] ?? null,
            ]
        );
    }

    public function findByCode(string $code)
    {
        return SystemLanguage::on('system')->where('code', $code)->first();
    }

    public function exists(string $code): bool
    {
        return SystemLanguage::on('system')->where('code', $code)->exists();
    }
}
