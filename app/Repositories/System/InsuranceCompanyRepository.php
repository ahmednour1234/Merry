<?php

namespace App\Repositories\System;

use App\Models\InsuranceCompany;
use App\Repositories\System\Contracts\InsuranceCompanyRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InsuranceCompanyRepository implements InsuranceCompanyRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = InsuranceCompany::on('system')->orderByDesc('created_at');

        if (!empty($filters['q'])) {
            $q->where(function($w) use ($filters) {
                $w->where('name', 'like', '%'.$filters['q'].'%')
                  ->orWhere('website', 'like', '%'.$filters['q'].'%');
            });
        }
        if (isset($filters['active'])) {
            $q->where('active', (bool)$filters['active']);
        }
        if (!empty($filters['from'])) $q->where('created_at', '>=', $filters['from']);
        if (!empty($filters['to']))   $q->where('created_at', '<=', $filters['to']);

        return $q->paginate($perPage)->appends(request()->query());
    }

    public function store(array $data): InsuranceCompany
    {
        return InsuranceCompany::on('system')->create($data);
    }

    public function update(int $id, array $data): ?InsuranceCompany
    {
        $row = InsuranceCompany::on('system')->find($id);
        if (!$row) return null;
        $row->fill($data)->save();
        return $row;
    }

    public function destroy(int $id): bool
    {
        $row = InsuranceCompany::on('system')->find($id);
        return $row ? (bool)$row->delete() : false;
    }

    public function toggle(int $id, bool $active): ?InsuranceCompany
    {
        $row = InsuranceCompany::on('system')->find($id);
        if (!$row) return null;
        $row->active = $active; $row->save();
        return $row;
    }
}
