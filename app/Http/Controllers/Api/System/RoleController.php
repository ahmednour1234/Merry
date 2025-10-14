<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\Role\StoreRoleRequest;
use App\Http\Requests\System\Role\UpdateRoleRequest;
use App\Http\Resources\System\RoleResource;
use App\Models\Role;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends ApiController
{
    public function __construct(private PermissionService $perms)
    {
        parent::__construct(app('api.responder'));
    }

    public function index(Request $r)
    {
        $q = Role::on('system')
            ->with('permissions')
            ->withCount('users') // << يعد المستخدمين
            ->orderBy('name');

        if ($r->filled('name'))   $q->where('name','like','%'.$r->name.'%');
        if ($r->filled('slug'))   $q->where('slug','like','%'.$r->slug.'%');
        if ($r->filled('guard'))  $q->where('guard',$r->guard);
        if ($r->filled('active')) $q->where('active',(bool)$r->boolean('active'));
        if ($r->filled('from'))   $q->where('created_at','>=',$r->date('from'));
        if ($r->filled('to'))     $q->where('created_at','<=',$r->date('to'));

        $per = (int)$r->integer('per_page',15);
        $p = $q->paginate($per>0?$per:15)->appends($r->query());

        return $this->responder->paginated($p, RoleResource::class, 'Roles');
    }

    public function store(StoreRoleRequest $r)
    {
        $d = $r->validated();
        $role = Role::on('system')->create([
            'name'=>$d['name'],'slug'=>$d['slug'],'guard'=>$d['guard'],
            'active'=> (bool)($d['active'] ?? true),
        ]);
        return $this->responder->created(new RoleResource($role->load('permissions')->loadCount('users')), 'Role created');
    }

    public function update(UpdateRoleRequest $r, $id)
    {
        $role = Role::on('system')->find($id);
        if (!$role) return $this->responder->fail('Role not found', status:404);
        $role->fill($r->validated())->save();
        return $this->responder->ok(new RoleResource($role->load('permissions')->loadCount('users')), 'Role updated');
    }

    public function toggle(Request $r, $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $role = Role::on('system')->find($id);
        if (!$role) return $this->responder->fail('Role not found', status:404);
        $role->active = $data['active']; $role->save();
        return $this->responder->ok(new RoleResource($role->loadCount('users')), 'Role status updated');
    }

    public function destroy($id)
    {
        $role = Role::on('system')->find($id);
        if (!$role) return $this->responder->fail('Role not found', status:404);
        $role->delete();
        return $this->responder->ok(null, 'Role deleted');
    }

    public function syncPermissions(Request $r, $id)
    {
        $role = Role::on('system')->find($id);
        if (!$role) return $this->responder->fail('Role not found', status:404);

        $data = $r->validate([
            'permissions'   => ['required','array'],
            'permissions.*' => ['integer','exists:system.permissions,id'],
        ]);
        $this->perms->syncRolePermissions($role, $data['permissions']);

        return $this->responder->ok(new RoleResource($role->load('permissions')->loadCount('users')), 'Role permissions synced');
    }
}
