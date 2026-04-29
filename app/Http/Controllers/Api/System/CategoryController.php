<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\Category\StoreCategoryRequest;
use App\Http\Requests\System\Category\UpdateCategoryRequest;
use App\Http\Requests\System\Category\UpsertCategoryTranslationRequest;
use App\Http\Resources\System\CategoryResource;
use App\Models\Category;
use App\Repositories\System\Contracts\CategoryRepositoryInterface as Repo;
use App\Support\Uploads\ImageUploader;
use Illuminate\Http\Request;

/**
 * @group System / Categories
 * @authenticated
 */
class CategoryController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * List categories
     * @queryParam q string Search slug/name. Example: clean
     * @queryParam active boolean Example: 1
     * @queryParam parent_id integer Example: 5
     * @queryParam from date
     * @queryParam to date
     * @queryParam per_page integer Example: 15
     */
    public function index(Request $r)
    {
        $filters = $r->only(['q','active','parent_id','from','to']);
        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $this->repo->paginate($filters, $per);

        return $this->responder->paginated($p, CategoryResource::class, 'Categories');
    }

    /**
     * Create category
     * @contentType multipart/form-data
     * @bodyParam parent_id integer nullable Example: 1
     * @bodyParam slug string nullable Example: home-cleaning
     * @bodyParam name string required Example: Home Cleaning
     * @bodyParam active boolean Example: 1
     * @bodyParam translations array Example: [{"lang_code":"ar","name":"تنظيف منزلي"}]
     */
    public function store(StoreCategoryRequest $r)
    {
        $data = $r->validated();
        if ($r->hasFile('icon')) {
            $data['icon'] = ImageUploader::upload($r->file('icon'), 'categories/icons');
        }
        $row = $this->repo->store($data);
        return $this->responder->created(new CategoryResource($row), 'Category created');
    }

    /**
     * Update category
     * @urlParam id integer required
     * @contentType multipart/form-data
     */
    public function update(UpdateCategoryRequest $r, int $id)
    {
        $data = $r->validated();
        if ($r->hasFile('icon')) {
            $row = Category::on('system')->find($id);
            if ($row?->icon) {
                ImageUploader::deleteIfExists($row->icon);
            }
            $data['icon'] = ImageUploader::upload($r->file('icon'), 'categories/icons');
        }
        $row = $this->repo->update($id, $data);
        if (!$row) return $this->responder->fail('Category not found', 404);
        return $this->responder->ok(new CategoryResource($row), 'Category updated');
    }

    /**
     * Delete category (soft)
     * @urlParam id integer required
     */
    public function destroy(int $id)
    {
        $ok = $this->repo->destroy($id);
        return $ok ? $this->responder->ok(null,'Category deleted')
                   : $this->responder->fail('Category not found',404);
    }

    /**
     * Toggle active
     * @urlParam id integer required
     * @bodyParam active boolean required Example: 1
     */
    public function toggle(Request $r, int $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle($id, (bool)$data['active']);
        if (!$row) return $this->responder->fail('Category not found',404);
        return $this->responder->ok(new CategoryResource($row), 'Category status updated');
    }

    /**
     * Upsert translation
     * @urlParam id integer required
     * @bodyParam lang_code string required Example: ar
     * @bodyParam name string required Example: تنظيف
     */
    public function upsertTranslation(UpsertCategoryTranslationRequest $r, int $id)
    {
        $ok = $this->repo->upsertTranslation($id, $r->input('lang_code'), $r->input('name'));
        if (!$ok) return $this->responder->fail('Category not found',404);
        return $this->responder->ok(null, 'Translation saved');
    }

    /**
     * Upload / replace category icon
     * @urlParam id integer required
     * @bodyParam icon file required Image file (jpg/png/svg/webp, max 5 MB)
     */
    public function uploadIcon(Request $r, int $id)
    {
        $r->validate(['icon' => ['required', 'file', 'image', 'max:5120']]);

        $row = Category::on('system')->find($id);
        if (!$row) return $this->responder->fail('Category not found', 404);

        if ($row->icon) {
            ImageUploader::deleteIfExists($row->icon);
        }

        $row->icon       = ImageUploader::upload($r->file('icon'), 'categories/icons');
        $row->updated_at = now();
        $row->save();

        return $this->responder->ok(new CategoryResource($row->fresh(['translations'])->loadCount('children')), 'Icon uploaded');
    }
}
