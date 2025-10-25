<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\CvResource;
use App\Repositories\System\Cv\Contracts\CvRepositoryInterface as Repo;
use Illuminate\Http\Request;

/**
 * @group System / CVs
 */
class CvController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * List CVs (filters supported)
     * @queryParam office_id int
     * @queryParam category_id int
     * @queryParam nationality string
     * @queryParam gender string male|female
     * @queryParam has_experience boolean
     * @queryParam status string pending|approved|rejected|frozen|deactivated_by_office
     * @queryParam from date
     * @queryParam to date
     * @queryParam per_page int
     */
    public function index(Request $r)
    {
        $filters = $r->only(['office_id','category_id','nationality','gender','has_experience','status','from','to']);
        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $this->repo->paginate($filters, $per);
        return $this->responder->paginated($p, CvResource::class, 'CVs');
    }

    /** Approve CV */
    public function approve(Request $r, int $id)
    {
        $adminId = (int)$r->user()?->id;
        $cv = $this->repo->approve($id, $adminId);
        if (!$cv) return $this->responder->fail('Not found', 404);
        return $this->responder->ok(new CvResource($cv), 'Approved');
    }

    /** Reject CV (reason required) */
    public function reject(Request $r, int $id)
    {
        $data = $r->validate(['reason'=>'required|string|max:2000']);
        $adminId = (int)$r->user()?->id;
        $cv = $this->repo->reject($id, $adminId, $data['reason']);
        if (!$cv) return $this->responder->fail('Not found', 404);
        return $this->responder->ok(new CvResource($cv), 'Rejected');
    }

    /** Freeze CV */
    public function freeze(Request $r, int $id)
    {
        $adminId = (int)$r->user()?->id;
        $cv = $this->repo->freeze($id, $adminId);
        if (!$cv) return $this->responder->fail('Not found', 404);
        return $this->responder->ok(new CvResource($cv), 'Frozen');
    }

    /** Unfreeze CV (back to pending) */
    public function unfreeze(Request $r, int $id)
    {
        $adminId = (int)$r->user()?->id;
        $cv = $this->repo->unfreeze($id, $adminId);
        if (!$cv) return $this->responder->fail('Not found', 404);
        return $this->responder->ok(new CvResource($cv), 'Unfrozen');
    }

    /** Delete CV */
    public function destroy(int $id)
    {
        $ok = $this->repo->destroy($id);
        return $ok ? $this->responder->ok(null,'Deleted') : $this->responder->fail('Not found',404);
    }

    /** Stats */
    public function stats(Request $r)
    {
        $filters = $r->only(['office_id','category_id','nationality','gender','has_experience','status','from','to']);
        $data = $this->repo->stats($filters);
        return $this->responder->ok($data, 'CVs stats');
    }
}
