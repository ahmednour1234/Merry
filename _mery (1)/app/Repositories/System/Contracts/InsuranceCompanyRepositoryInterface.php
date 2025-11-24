<?php

namespace App\Repositories\System\Contracts;

use App\Models\InsuranceCompany;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface InsuranceCompanyRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function store(array $data): InsuranceCompany;
    public function update(int $id, array $data): ?InsuranceCompany;
    public function destroy(int $id): bool;
    public function toggle(int $id, bool $active): ?InsuranceCompany;
}
