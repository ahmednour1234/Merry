<?php

namespace App\Services;

use App\Models\Office;
use App\Repositories\System\Contracts\OfficeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OfficeService
{
    public function __construct(protected OfficeRepositoryInterface $repo) {}

    /**
     * List all active offices with optional filters & pagination.
     */
    public function listActive(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->repo->paginate($filters, $perPage);
    }

    /**
     * Get a single active office or throw 404.
     */
    public function findOrFail(int $id): Office
    {
        $office = $this->repo->findActive($id);

        if (!$office) {
            abort(404, 'المكتب غير موجود أو غير نشط.');
        }

        return $office;
    }

    /**
     * Get paginated approved & available (unbooked) CVs of an office.
     */
    public function availableCvs(int $officeId, array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        // Validate office exists first
        $this->findOrFail($officeId);

        return $this->repo->paginateCvs($officeId, $filters, $perPage);
    }
}
