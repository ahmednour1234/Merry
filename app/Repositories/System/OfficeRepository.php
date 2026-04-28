<?php

namespace App\Repositories\System;

use App\Models\Cv;
use App\Models\Office;
use App\Repositories\System\Contracts\OfficeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OfficeRepository implements OfficeRepositoryInterface
{
    /**
     * Paginate active offices with optional filters.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = Office::on('system')
            ->where('active', true)
            ->where('blocked', false)
            ->orderByDesc('created_at');

        if (!empty($filters['q'])) {
            $q->where(function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['q'] . '%')
                      ->orWhere('city_id', 'like', '%' . $filters['q'] . '%');
            });
        }

        if (!empty($filters['city_id'])) {
            $q->where('city_id', $filters['city_id']);
        }

        return $q->paginate($perPage)->appends(request()->query());
    }

    /**
     * Find a single active (non-blocked) office.
     */
    public function findActive(int $id): ?Office
    {
        return Office::on('system')
            ->where('active', true)
            ->where('blocked', false)
            ->find($id);
    }

    /**
     * Paginate approved, unbooked CVs belonging to an office.
     * A CV is considered "available" when:
     *   - status = 'approved'
     *   - NOT currently active-booked (no active CvBooking row)
     */
    public function paginateCvs(int $officeId, array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        // IDs that are actively booked (any active booking status)
        $bookedIds = \App\Models\CvBooking::on('system')
            ->whereIn('status', \App\Enums\BookingStatus::activeStatuses())
            ->pluck('cv_id')
            ->toArray();

        $q = Cv::on('system')
            ->with(['nationality.translations', 'category'])
            ->where('office_id', $officeId)
            ->where('status', 'approved')
            ->when(!empty($bookedIds), fn($query) => $query->whereNotIn('id', $bookedIds))
            ->orderByDesc('created_at');

        if (!empty($filters['nationality_code'])) {
            $q->where('nationality_code', $filters['nationality_code']);
        }

        if (!empty($filters['gender'])) {
            $q->where('gender', $filters['gender']);
        }

        if (isset($filters['has_experience'])) {
            $q->where('has_experience', (bool) $filters['has_experience']);
        }

        if (isset($filters['is_muslim'])) {
            $q->where('is_muslim', (bool) $filters['is_muslim']);
        }

        if (!empty($filters['category_id'])) {
            $q->where('category_id', $filters['category_id']);
        }

        return $q->paginate($perPage)->appends(request()->query());
    }
}
