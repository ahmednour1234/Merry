<?php

namespace App\Repositories\System\Cv;

use App\Models\Cv;
use App\Repositories\System\Cv\Contracts\CvRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Support\Files\PdfUpload;

class CvRepository implements CvRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $q = Cv::on('system')
            ->with(['office','category','nationality.translations'])
            ->orderByDesc('created_at')
            ->filter($filters);
        return $q->paginate($perPage)->appends(request()->query());
    }

    public function find(int $id): ?Cv
    {
        return Cv::on('system')
            ->with(['office','category','nationality.translations'])
            ->find($id);
    }

    public function store(array $data, ?int $officeId = null): Cv
    {
        return DB::connection('system')->transaction(function () use ($data, $officeId) {
            if (!empty($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
                $up = PdfUpload::store($data['file'], 'cvs');
                $data = array_merge($data, [
                    'file_path' => $up['path'],
                    'file_mime' => $up['mime'],
                    'file_size' => $up['size'],
                    'file_original_name' => $up['original_name'],
                ]);
                unset($data['file']);
            }
            $data['office_id'] = $officeId ?? ($data['office_id'] ?? null);
            $data['status'] = $data['status'] ?? 'pending';
            $cv = Cv::on('system')->create($data);
            return $cv->load(['office','category','nationality.translations']);
        });
    }

    public function update(int $id, array $data): ?Cv
    {
        return DB::connection('system')->transaction(function () use ($id, $data) {
            $cv = Cv::on('system')->find($id);
            if (!$cv) return null;

            if (!empty($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
                $up = PdfUpload::store($data['file'], 'cvs');
                $data = array_merge($data, [
                    'file_path' => $up['path'],
                    'file_mime' => $up['mime'],
                    'file_size' => $up['size'],
                    'file_original_name' => $up['original_name'],
                ]);
                unset($data['file']);
            }

            $cv->fill($data)->save();
            return $cv->load(['office','category','nationality.translations']);
        });
    }

    public function destroy(int $id): bool
    {
        $cv = Cv::on('system')->find($id);
        return $cv ? (bool)$cv->delete() : false;
    }

    public function approve(int $id, int $adminId): ?Cv
    {
        $cv = Cv::on('system')->find($id);
        if (!$cv) return null;
        $cv->status = 'approved';
        $cv->approved_by = $adminId;
        $cv->approved_at = now();
        $cv->rejected_by = null; $cv->rejected_at = null; $cv->rejected_reason = null;
        $cv->frozen_by = null; $cv->frozen_at = null;
        $cv->save();
        return $cv->load(['office','category','nationality.translations']);
    }

    public function reject(int $id, int $adminId, string $reason): ?Cv
    {
        $cv = Cv::on('system')->find($id);
        if (!$cv) return null;
        $cv->status = 'rejected';
        $cv->rejected_by = $adminId;
        $cv->rejected_at = now();
        $cv->rejected_reason = $reason;
        $cv->approved_by = null; $cv->approved_at = null;
        $cv->save();
        return $cv->load(['office','category','nationality.translations']);
    }

    public function freeze(int $id, int $adminId): ?Cv
    {
        $cv = Cv::on('system')->find($id);
        if (!$cv) return null;
        $cv->status = 'frozen';
        $cv->frozen_by = $adminId;
        $cv->frozen_at = now();
        $cv->save();
        return $cv->load(['office','category','nationality.translations']);
    }

    public function unfreeze(int $id, int $adminId): ?Cv
    {
        $cv = Cv::on('system')->find($id);
        if (!$cv) return null;
        // رجّعه pending (أو approved حسب مانت عايز)
        $cv->status = 'pending';
        $cv->frozen_by = null;
        $cv->frozen_at = null;
        $cv->save();
        return $cv->load(['office','category','nationality.translations']);
    }

    public function officeToggleActive(int $id, int $officeId, bool $active): ?Cv
    {
        $cv = Cv::on('system')->where('office_id',$officeId)->find($id);
        if (!$cv) return null;

        if ($active) {
            // re-activate: لو كان متوقف بواسطة المكتب
            $cv->status = 'pending'; // يرجع للمراجعة
            $cv->deactivated_by_office_at = null;
        } else {
            $cv->status = 'deactivated_by_office';
            $cv->deactivated_by_office_at = now();
        }
        $cv->save();
        return $cv->load(['office','category','nationality.translations']);
    }

    public function stats(array $filters = []): array
    {
        $base = Cv::on('system')->filter($filters);

        $byStatus = (clone $base)
            ->select('status', DB::raw('COUNT(*) as c'))
            ->groupBy('status')->pluck('c','status')->toArray();

        $byNationality = (clone $base)
            ->select('nationality_code', DB::raw('COUNT(*) as c'))
            ->groupBy('nationality_code')->pluck('c','nationality_code')->toArray();

        $byCategory = (clone $base)
            ->select('category_id', DB::raw('COUNT(*) as c'))
            ->groupBy('category_id')->pluck('c','category_id')->toArray();

        return [
            'total' => (clone $base)->count(),
            'by_status' => $byStatus,
            'by_nationality' => $byNationality,
            'by_category' => $byCategory,
        ];
    }
}
