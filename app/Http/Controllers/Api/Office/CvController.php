<?php

namespace App\Http\Controllers\Api\Office;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\Cv\StoreCvRequest;
use App\Http\Requests\System\Cv\UpdateCvRequest;
use App\Http\Resources\System\CvResource;
use App\Repositories\System\Cv\Contracts\CvRepositoryInterface as Repo;
use Illuminate\Http\Request;

/**
 * @group Office / CVs
 */
class CvController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app('api.responder'));
    }

    /** GET /api/v1/office/cvs - List my CVs */
    public function index(Request $request)
    {
        $filters = $request->only([
            'category_id',
            'nationality_code',
            'gender',
            'has_experience',
            'status',
            'from',
            'to',
        ]);

        // المكتب الحالي من التوكن
        $filters['office_id'] = (int) $request->user()->id;

        $perPage   = max(1, (int) $request->integer('per_page', 15));
        $paginator = $this->repo->paginate($filters, $perPage);

        return $this->responder->paginated(
            $paginator,
            CvResource::class,
            'My CVs'
        );
    }

    /**
     * POST /api/v1/office/cvs
     *
     * يدعم:
     * - Single:
     *   fields: category_id, nationality_code, gender, has_experience, is_muslim, file, meta
     *
     * - Bulk:
     *   cvs[]: نفس الحقول لكل عنصر
     */
    public function store(StoreCvRequest $request)
    {
        $officeId  = (int) $request->user()->id;
        $validated = $request->validated();

        // Bulk mode
        if (isset($validated['cvs']) && is_array($validated['cvs'])) {
            $items = [];

            foreach ($validated['cvs'] as $cvData) {
                $items[] = new CvResource(
                    $this->repo->store($cvData, $officeId)
                );
            }

            return $this->responder->created(
                $items,
                'CVs submitted (pending review)'
            );
        }

        // Single mode
        $cv = $this->repo->store($validated, $officeId);

        return $this->responder->created(
            new CvResource($cv),
            'CV submitted (pending review)'
        );
    }

    /** PUT/PATCH /api/v1/office/cvs/{id} - Update CV */
    public function update(UpdateCvRequest $request, int $id)
    {
        $cv = $this->repo->find($id);

        if (!$cv || (int) $cv->office_id !== (int) $request->user()->id) {
            return $this->responder->fail('Not found', 404);
        }

        if (!in_array($cv->status, ['pending', 'rejected', 'deactivated_by_office'], true)) {
            return $this->responder->fail('Cannot update in this status', 422);
        }

        $row = $this->repo->update($id, $request->validated());

        return $this->responder->ok(
            new CvResource($row),
            'CV updated'
        );
    }

    /** POST /api/v1/office/cvs/{id}/toggle-active */
    public function toggleActive(Request $request, int $id)
    {
        $data = $request->validate([
            'active' => ['required', 'boolean'],
        ]);

        $row = $this->repo->officeToggleActive(
            $id,
            (int) $request->user()->id,
            (bool) $data['active']
        );

        if (!$row) {
            return $this->responder->fail('Not found', 404);
        }

        return $this->responder->ok(
            new CvResource($row),
            'CV state changed'
        );
    }

    /** DELETE /api/v1/office/cvs/{id} */
    public function destroy(Request $request, int $id)
    {
        $cv = $this->repo->find($id);

        if (!$cv || (int) $cv->office_id !== (int) $request->user()->id) {
            return $this->responder->fail('Not found', 404);
        }

        $ok = $this->repo->destroy($id);

        return $ok
            ? $this->responder->ok(null, 'Deleted')
            : $this->responder->fail('Not found', 404);
    }

    /** POST /api/v1/office/cvs/{id}/resubmit */
    public function resubmit(Request $request, int $id)
    {
        $cv = $this->repo->find($id);

        if (!$cv || (int) $cv->office_id !== (int) $request->user()->id) {
            return $this->responder->fail('Not found', 404);
        }

        if ($cv->status !== 'rejected') {
            return $this->responder->fail('Only rejected CVs can be resubmitted', 422);
        }

        $cv->status          = 'pending';
        $cv->rejected_by     = null;
        $cv->rejected_at     = null;
        $cv->rejected_reason = null;
        $cv->save();

        return $this->responder->ok(
            new CvResource($cv),
            'Resubmitted (pending)'
        );
    }
}
