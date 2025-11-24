<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\ExchangeRate\StoreExchangeRateRequest;
use App\Http\Resources\System\ExchangeRateResource;
use App\Repositories\System\Contracts\ExchangeRateRepositoryInterface as Repo;
use Illuminate\Http\Request;

class ExchangeRateController extends ApiController
{
    public function __construct(protected Repo $repo){ parent::__construct(app('api.responder')); }

    /**
     * @group System / Exchange Rates
     * List exchange rates (paginated). Use ?all=1 to return all.
     */
    public function index(Request $r)
    {
        $per = (int) $r->integer('per_page', 15);
        if ($per === 0 || $r->boolean('all')) {
            $all = $this->repo->all();
            return $this->responder->ok(ExchangeRateResource::collection($all), 'Exchange rates', ['pagination'=>null]);
        }
        $p = $this->repo->paginate($per);
        return $this->responder->paginated($p, ExchangeRateResource::class, 'Exchange rates');
    }

    /**
     * @group System / Exchange Rates
     * Upsert a rate (base-quote).
     */
    public function store(StoreExchangeRateRequest $r)
    {
        $d = $r->validated();
        $row = $this->repo->upsert($d['base'], $d['quote'], (float)$d['rate'], $d['fetched_at'] ?? null, (bool)($d['active'] ?? true));
        return $this->responder->created(new ExchangeRateResource($row), 'Exchange rate saved');
    }

    /**
     * @group System / Exchange Rates
     * Toggle active for a pair.
     */
    public function toggle(Request $r)
    {
        $data = $r->validate([
            'base'   => ['required','string','max:8'],
            'quote'  => ['required','string','max:8','different:base'],
            'active' => ['required','boolean'],
        ]);
        $row = $this->repo->toggle($data['base'], $data['quote'], $data['active']);
        if (!$row) return $this->responder->fail('Rate not found', status:404);
        return $this->responder->ok(new ExchangeRateResource($row), 'Exchange rate status updated');
    }
}
