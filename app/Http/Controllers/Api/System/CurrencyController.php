<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\Currency\StoreCurrencyRequest;
use App\Http\Requests\System\Currency\UpdateCurrencyRequest;
use App\Http\Resources\System\CurrencyResource;
use App\Repositories\System\Contracts\CurrencyRepositoryInterface as Repo;
use Illuminate\Http\Request;

class CurrencyController extends ApiController
{
    public function __construct(protected Repo $repo){ parent::__construct(app('api.responder')); }

    /**
     * @group System / Currencies
     * List currencies (paginated). Use ?all=1 to return all.
     */
    public function index(Request $r)
    {
        $per = (int) $r->integer('per_page', 15);
        if ($per === 0 || $r->boolean('all')) {
            $all = $this->repo->all();
            return $this->responder->ok(CurrencyResource::collection($all), 'Currencies', ['pagination'=>null]);
        }
        $p = $this->repo->paginate($per);
        return $this->responder->paginated($p, CurrencyResource::class, 'Currencies');
    }

    /**
     * @group System / Currencies
     * Upsert a currency.
     */
    public function store(StoreCurrencyRequest $r)
    {
        $row = $this->repo->store($r->validated());
        return $this->responder->created(new CurrencyResource($row), 'Currency saved');
    }

    /**
     * @group System / Currencies
     * Update a currency.
     */
    public function update(string $code, UpdateCurrencyRequest $r)
    {
        $row = $this->repo->update($code, $r->validated());
        if (!$row) return $this->responder->fail('Currency not found', status:404);
        return $this->responder->ok(new CurrencyResource($row), 'Currency updated');
    }

    /**
     * @group System / Currencies
     * Soft-delete a currency.
     */
    public function destroy(string $code)
    {
        $ok = $this->repo->destroy($code);
        return $ok ? $this->responder->ok(null, 'Currency deleted') : $this->responder->fail('Currency not found', status:404);
    }

    /**
     * @group System / Currencies
     * Toggle active flag.
     */
    public function toggle(Request $r, string $code)
    {
        $active = $r->boolean('active', true);
        $row = $this->repo->toggle($code, $active);
        if (!$row) return $this->responder->fail('Currency not found', status:404);
        return $this->responder->ok(new CurrencyResource($row), 'Currency status updated');
    }
}
