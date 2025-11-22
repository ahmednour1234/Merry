<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\Page\StorePageRequest;
use App\Http\Requests\System\Page\UpdatePageRequest;
use App\Http\Resources\System\PageResource;
use App\Repositories\System\Contracts\PageRepositoryInterface as Repo;
use Illuminate\Http\Request;

class PageController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * @group System / Pages
     * List pages
     * @queryParam q string Search in title/content. Example: policy
     * @queryParam active boolean Example: 1
     * @queryParam per_page integer Example: 15
     */
    public function index(Request $r)
    {
        $filters = $r->only(['q','active','slug']);
        $per = (int) $r->integer('per_page', 15);
        $p = $this->repo->paginate($filters, $per > 0 ? $per : 15);
        $p->getCollection()->load('translations');
        return $this->responder->paginated($p, PageResource::class, 'Pages');
    }

    /**
     * @group System / Pages
     * Create a page with translations
     */
    public function store(StorePageRequest $r)
    {
        $row = $this->repo->store($r->validated());
        return $this->responder->created(new PageResource($row->load('translations')), 'Page created');
    }

    /**
     * @group System / Pages
     * Update a page and/or its translations
     */
    public function update($id, UpdatePageRequest $r)
    {
        $row = $this->repo->update((int)$id, $r->validated());
        if (!$row) return $this->responder->fail('Page not found', status:404);
        return $this->responder->ok(new PageResource($row->load('translations')), 'Page updated');
    }

    /**
     * @group System / Pages
     * Soft delete a page
     */
    public function destroy($id)
    {
        $ok = $this->repo->destroy((int)$id);
        return $ok ? $this->responder->ok(null, 'Page deleted') : $this->responder->fail('Page not found', status:404);
    }

    /**
     * @group System / Pages
     * Toggle active
     * @bodyParam active boolean required Example: true
     */
    public function toggle(Request $r, $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle((int)$id, (bool)$data['active']);
        if (!$row) return $this->responder->fail('Page not found', status:404);
        return $this->responder->ok(new PageResource($row->load('translations')), 'Page status updated');
    }
}


