<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\Permission\StorePermissionRequest;
use App\Http\Requests\System\Permission\UpdatePermissionRequest;
use App\Http\Resources\System\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends ApiController
{
    public function __construct(){ parent::__construct(app('api.responder')); }

    public function index(Request $r)
    {
        $q = Permission::on('system')->orderBy('slug');

        if ($r->filled('name'))   $q->where('name','like','%'.$r->name.'%');
        if ($r->filled('slug'))   $q->where('slug','like','%'.$r->slug.'%');
        if ($r->filled('guard'))  $q->where('guard',$r->guard);
        if ($r->filled('active')) $q->where('active',(bool)$r->boolean('active'));
        if ($r->filled('from'))   $q->where('created_at','>=',$r->date('from'));
        if ($r->filled('to'))     $q->where('created_at','<=',$r->date('to'));

        $per = (int)$r->integer('per_page',15);
        $p = $q->paginate($per>0?$per:15)->appends($r->query());

        return $this->responder->paginated($p, PermissionResource::class, 'Permissions');
    }

    public function store(StorePermissionRequest $r)
    {
        $d = $r->validated();
        $perm = Permission::on('system')->create([
            'name'=>$d['name'],'slug'=>$d['slug'],'guard'=>$d['guard'],
            'active'=> (bool)($d['active'] ?? true),
        ]);
        return $this->responder->created(new PermissionResource($perm), 'Permission created');
    }

    public function update(UpdatePermissionRequest $r, $id)
    {
        $perm = Permission::on('system')->find($id);
        if (!$perm) return $this->responder->fail('Permission not found', status:404);
        $perm->fill($r->validated())->save();
        return $this->responder->ok(new PermissionResource($perm), 'Permission updated');
    }

    public function toggle(Request $r, $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $perm = Permission::on('system')->find($id);
        if (!$perm) return $this->responder->fail('Permission not found', status:404);
        $perm->active = $data['active']; $perm->save();
        return $this->responder->ok(new PermissionResource($perm), 'Permission status updated');
    }

    public function destroy($id)
    {
        $perm = Permission::on('system')->find($id);
        if (!$perm) return $this->responder->fail('Permission not found', status:404);
        $perm->delete();
        return $this->responder->ok(null, 'Permission deleted');
    }
}
