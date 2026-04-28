<?php

namespace App\Repositories\System\Contracts;

use App\Models\Office;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OfficeRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function findActive(int $id): ?Office;

    public function paginateCvs(int $officeId, array $filters = [], int $perPage = 15): LengthAwarePaginator;
}
