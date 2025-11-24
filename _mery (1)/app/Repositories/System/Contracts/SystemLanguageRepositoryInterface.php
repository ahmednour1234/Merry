<?php

namespace App\Repositories\System\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SystemLanguageRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function all(): Collection;

    public function store(array $data);

    public function findByCode(string $code);

    public function exists(string $code): bool;
}
