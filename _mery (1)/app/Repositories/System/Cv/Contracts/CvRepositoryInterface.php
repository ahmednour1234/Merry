<?php

namespace App\Repositories\System\Cv\Contracts;

use App\Models\Cv;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CvRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?Cv;

    public function store(array $data, ?int $officeId = null): Cv;
    public function update(int $id, array $data): ?Cv;
    public function destroy(int $id): bool;

    // حالات
    public function approve(int $id, int $adminId): ?Cv;
    public function reject(int $id, int $adminId, string $reason): ?Cv;
    public function freeze(int $id, int $adminId): ?Cv;
    public function unfreeze(int $id, int $adminId): ?Cv;

    public function officeToggleActive(int $id, int $officeId, bool $active): ?Cv;

    // إحصائيات
    public function stats(array $filters = []): array;
}
