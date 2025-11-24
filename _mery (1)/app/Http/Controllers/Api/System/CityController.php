<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\City\StoreCityRequest;
use App\Http\Requests\System\City\UpdateCityRequest;
use App\Http\Resources\System\CityResource;
use App\Repositories\System\Contracts\CityRepositoryInterface as Repo;
use Illuminate\Http\Request;

class CityController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * @group System / Cities
     * List cities
     * @queryParam q string Search by translated name. Example: Riy
     * @queryParam country string ISO-2 country. Example: SA
     * @queryParam active boolean Example: 1
     * @queryParam from date Example: 2025-10-01
     * @queryParam to date Example: 2025-10-15
     * @queryParam per_page integer Example: 15
     */
   public function index(Request $r)
{
    $filters = $r->only(['q','country','active','from','to']);
    $per = (int) $r->integer('per_page', 15);

    // دعم ?all=1 أو ?per_page=0 لإرجاع كل النتائج بدون paginate
    if ($per === 0 || $r->boolean('all')) {
        $paginated = app(\App\Repositories\System\Contracts\CityRepositoryInterface::class)
            ->paginate($filters, PHP_INT_MAX);   // نطلب رقم كبير

        // إذا الكائن يرجع getCollection() نستخدمها، وإلا نبني Eloquent Collection من العناصر
        if (is_object($paginated) && method_exists($paginated, 'getCollection')) {
            $all = $paginated->getCollection();                  // ناخد الكولكشن فقط
        } elseif (is_object($paginated) && method_exists($paginated, 'items')) {
            $all = \Illuminate\Database\Eloquent\Collection::make($paginated->items());
        } elseif (is_array($paginated)) {
            $all = \Illuminate\Database\Eloquent\Collection::make($paginated);
        } else {
            $all = \Illuminate\Database\Eloquent\Collection::make((array) $paginated);
        }

        // لو حابب بدون paginate نهائيًا:
        // $all = \App\Models\City::on('system')->with('translations')->get();

        $all->load('translations');
        return $this->responder->ok(
            \App\Http\Resources\System\CityResource::collection($all),
            'Cities list',
            meta: ['pagination' => null]
        );
    }

    // الحالة الطبيعية (paginate)
    $p = $this->repo->paginate($filters, $per > 0 ? $per : 15);

    // حمّل الـ translations على مجموعة العناصر داخل الـ paginator
    $p->getCollection()->load('translations');

    return $this->responder->paginated(
        $p,
        \App\Http\Resources\System\CityResource::class,
        'Cities'
    );
}

    /**
     * @group System / Cities
     * Create a city with translations
     * @bodyParam slug string Unique slug. Example: riyadh
     * @bodyParam country_code string ISO-2. Example: SA
     * @bodyParam active boolean Example: true
     * @bodyParam translations object required Map of lang_code=>name. Example: {"ar":"الرياض","en":"Riyadh"}
     */
    public function store(StoreCityRequest $r)
    {
        $row = $this->repo->store($r->validated());
        return $this->responder->created(new CityResource($row->load('translations')), 'City created');
    }

    /**
     * @group System / Cities
     * Update a city and/or its translations
     */
    public function update($id, UpdateCityRequest $r)
    {
        $row = $this->repo->update((int)$id, $r->validated());
        if (!$row) return $this->responder->fail('City not found', status:404);
        return $this->responder->ok(new CityResource($row->load('translations')), 'City updated');
    }

    /**
     * @group System / Cities
     * Soft delete a city
     */
    public function destroy($id)
    {
        $ok = $this->repo->destroy((int)$id);
        return $ok ? $this->responder->ok(null, 'City deleted') : $this->responder->fail('City not found', status:404);
    }

    /**
     * @group System / Cities
     * Toggle active
     * @bodyParam active boolean required Example: true
     */
    public function toggle(Request $r, $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle((int)$id, (bool)$data['active']);
        if (!$row) return $this->responder->fail('City not found', status:404);
        return $this->responder->ok(new CityResource($row->load('translations')), 'City status updated');
    }
}
