<?php

namespace App\Http\Controllers\Api\Office;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Cv\StoreCvRequest;
use App\Http\Requests\Cv\UpdateCvRequest;
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

    /** List my CVs */
    public function index(Request $r)
    {
        $filters = $r->only(['category_id','nationality','gender','has_experience','status','from','to']);
        $filters['office_id'] = (int)$r->user()->id; // المكتب نفسه (لو id المكتب هو user()->id)
        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $this->repo->paginate($filters, $per);
        return $this->responder->paginated($p, CvResource::class, 'My CVs');
    }

    /** Create CV (PDF required) */
    public function store(StoreCvRequest $r)
    {
        $data = $r->validated();
        $cv = $this->repo->store($data, (int)$r->user()->id);
        return $this->responder->created(new CvResource($cv), 'CV submitted (pending review)');
    }

    /** Update CV (allowed usually if pending or rejected) */
    public function update(UpdateCvRequest $r, int $id)
    {
        $cv = $this->repo->find($id);
        if (!$cv || $cv->office_id != $r->user()->id) {
            return $this->responder->fail('Not found',404);
        }
        if (!in_array($cv->status, ['pending','rejected','deactivated_by_office'])) {
            return $this->responder->fail('Cannot update in this status', 422);
        }
        $row = $this->repo->update($id, $r->validated());
        return $this->responder->ok(new CvResource($row), 'CV updated');
    }

    /** Office toggle active (deactivate/activate -> pending) */
    public function toggleActive(Request $r, int $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->officeToggleActive($id, (int)$r->user()->id, (bool)$data['active']);
        if (!$row) return $this->responder->fail('Not found',404);
        return $this->responder->ok(new CvResource($row), 'CV state changed');
    }

    /** Delete my CV */
    public function destroy(Request $r, int $id)
    {
        $cv = $this->repo->find($id);
        if (!$cv || $cv->office_id != $r->user()->id) {
            return $this->responder->fail('Not found',404);
        }
        $ok = $this->repo->destroy($id);
        return $ok ? $this->responder->ok(null, 'Deleted') : $this->responder->fail('Not found',404);
    }

    /** Resubmit rejected CV to pending */
    public function resubmit(Request $r, int $id)
    {
        $cv = $this->repo->find($id);
        if (!$cv || $cv->office_id != $r->user()->id) {
            return $this->responder->fail('Not found',404);
        }
        if ($cv->status !== 'rejected') {
            return $this->responder->fail('Only rejected CVs can be resubmitted', 422);
        }
        $cv->status = 'pending';
        $cv->rejected_by = null; $cv->rejected_at = null; $cv->rejected_reason = null;
        $cv->save();
        return $this->responder->ok(new CvResource($cv), 'Resubmitted (pending)');
    }
}
