<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Office\StoreOfficeRequest;
use App\Http\Requests\Office\UpdateOfficeRequest;
use App\Http\Resources\Office\OfficeResource;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OfficeController extends ApiController
{
    public function __construct()
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * @group System / Offices
     * @queryParam q string Search name/email/CR. Example: 1010
     * @queryParam city_id integer
     * @queryParam active boolean
     * @queryParam blocked boolean
     * @queryParam from date
     * @queryParam to date
     * @queryParam per_page integer
     */
    public function index(Request $r)
    {
        $q = Office::on('system')->orderByDesc('created_at');

        if ($s = $r->string('q')) {
            $s = '%'.$s.'%';
            $q->where(function($w) use ($s) {
                $w->where('name','like',$s)
                  ->orWhere('email','like',$s)
                  ->orWhere('commercial_reg_no','like',$s);
            });
        }
        if ($r->filled('city_id')) $q->where('city_id', $r->integer('city_id'));
        if ($r->has('active'))    $q->where('active', (bool)$r->boolean('active'));
        if ($r->has('blocked'))   $q->where('blocked', (bool)$r->boolean('blocked'));
        if ($r->filled('from'))   $q->where('created_at', '>=', $r->input('from'));
        if ($r->filled('to'))     $q->where('created_at', '<=', $r->input('to'));

        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $q->paginate($per)->appends($r->query());

        return $this->responder->paginated($p, OfficeResource::class, 'Offices');
    }

    public function store(StoreOfficeRequest $r)
    {
        $data = $r->validated();
        $data['password'] = Hash::make($data['password']);

        $row = Office::on('system')->create($data);
        return $this->responder->created(new OfficeResource($row), 'Office created');
    }

    public function update($id, UpdateOfficeRequest $r)
    {
        $row = Office::on('system')->find((int)$id);
        if (!$row) return $this->responder->fail('Office not found', status:404);

        $data = $r->validated();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $row->fill($data)->save();
        return $this->responder->ok(new OfficeResource($row), 'Office updated');
    }

    /** حظر/إلغاء حظر */
    public function block(Request $r, $id)
    {
        $r->validate(['blocked'=>'required|boolean']);
        $row = Office::on('system')->find((int)$id);
        if (!$row) return $this->responder->fail('Office not found', status:404);

        $row->blocked = (bool)$r->boolean('blocked');
        $row->save();

        return $this->responder->ok(new OfficeResource($row), 'Office block status updated');
    }

    /** تفعيل/تعطيل */
    public function toggle(Request $r, $id)
    {
        $r->validate(['active'=>'required|boolean']);
        $row = Office::on('system')->find((int)$id);
        if (!$row) return $this->responder->fail('Office not found', status:404);

        $row->active = (bool)$r->boolean('active');
        $row->save();

        return $this->responder->ok(new OfficeResource($row), 'Office status updated');
    }

    public function destroy($id)
    {
        $row = Office::on('system')->find((int)$id);
        if (!$row) return $this->responder->fail('Office not found', status:404);

        $row->delete();
        return $this->responder->ok(null, 'Office deleted');
    }
}
