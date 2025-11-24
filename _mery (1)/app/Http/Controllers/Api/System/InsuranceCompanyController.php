<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\InsuranceCompany\StoreInsuranceCompanyRequest;
use App\Http\Requests\System\InsuranceCompany\UpdateInsuranceCompanyRequest;
use App\Http\Resources\System\InsuranceCompanyResource;
use App\Repositories\System\Contracts\InsuranceCompanyRepositoryInterface as Repo;
use App\Support\Uploads\ImageUploader;
use Illuminate\Http\Request;

class InsuranceCompanyController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * @group System / Insurance Companies
     * @queryParam q string Search name/website. Example: comp
     * @queryParam active boolean Example: 1
     * @queryParam from date Example: 2025-10-01
     * @queryParam to date Example: 2025-10-15
     * @queryParam per_page integer Example: 15
     */
    public function index(Request $r)
    {
        $filters = $r->only(['q','active','from','to']);
        $per = (int) $r->integer('per_page', 15);
        $p = $this->repo->paginate($filters, $per > 0 ? $per : 15);

        return $this->responder->paginated($p, InsuranceCompanyResource::class, 'Insurance companies');
    }

    /**
     * @group System / Insurance Companies
     * @bodyParam name string required
     * @bodyParam website string
     * @bodyParam logo file image
     * @bodyParam active boolean
     */
    public function store(StoreInsuranceCompanyRequest $r)
    {
        $data = $r->validated();
        if ($r->hasFile('logo')) {
            $data['logo_path'] = ImageUploader::upload($r->file('logo'), 'insurance_companies');
        }
        $row = $this->repo->store($data);
        return $this->responder->created(new InsuranceCompanyResource($row), 'Company created');
    }

    /**
     * @group System / Insurance Companies
     * @bodyParam name string
     * @bodyParam website string
     * @bodyParam logo file image
     * @bodyParam active boolean
     */
    public function update($id, UpdateInsuranceCompanyRequest $r)
    {
        $data = $r->validated();
        if ($r->hasFile('logo')) {
            // احذف القديم لو موجود
            $old = \App\Models\InsuranceCompany::on('system')->find((int)$id);
            if ($old && $old->logo_path) {
                ImageUploader::deleteIfExists($old->logo_path);
            }
            $data['logo_path'] = ImageUploader::upload($r->file('logo'), 'insurance_companies');
        }

        $row = $this->repo->update((int)$id, $data);
        if (!$row) return $this->responder->fail('Company not found', status:404);

        return $this->responder->ok(new InsuranceCompanyResource($row), 'Company updated');
    }

    /** @group System / Insurance Companies */
    public function destroy($id)
    {
        $ok = $this->repo->destroy((int)$id);
        return $ok ? $this->responder->ok(null, 'Company deleted') : $this->responder->fail('Company not found', status:404);
    }

    /**
     * @group System / Insurance Companies
     * @bodyParam active boolean required Example: true
     */
    public function toggle(Request $r, $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle((int)$id, (bool)$data['active']);
        if (!$row) return $this->responder->fail('Company not found', status:404);
        return $this->responder->ok(new InsuranceCompanyResource($row), 'Company status updated');
    }
}
