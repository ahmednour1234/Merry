<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\Role\StoreRoleRequest;
use App\Http\Requests\System\Role\UpdateRoleRequest;
use App\Http\Resources\System\RoleResource;
use App\Models\Role;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class RoleController extends ApiController
{
    public function __construct(private PermissionService $perms)
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * @group System / Roles
     * @authenticated
     * List roles
     *
     * فلاتر اختيارية: الاسم/السلَج/الحارس/الحالة/التاريخ.
     *
     * @queryParam name string Example: Admin
     * @queryParam slug string Example: admin
     * @queryParam guard string Example: api
     * @queryParam active boolean Example: 1
     * @queryParam from date Example: 2025-01-01
     * @queryParam to date Example: 2025-12-31
     * @queryParam per_page integer Example: 15
     */
    public function index(Request $r)
    {
        $q = Role::on('system')
            ->with('permissions')
            ->withCount('users')
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

    /**
     * @group System / Roles
     * @authenticated
     * Create role (with permissions)
     *
     * ينشئ دور جديد ومعاه صلاحياته (اختياري).
     *
     * @contentType multipart/form-data
     *
     * @bodyParam name string required Role display name. Example: Admin
     * @bodyParam slug string required Unique slug per guard. Example: admin
     * @bodyParam guard string required Auth guard. Example: api
     * @bodyParam active boolean Active flag. Example: 1
     * @bodyParam permissions int[] List of permission IDs to attach. Example: [1,3,5]
     */
    public function store(StoreRoleRequest $r)
    {
        $d = $r->validated();

        $role = Role::on('system')->create([
            'name'   => $d['name'],
            'slug'   => $d['slug'],
            'guard'  => $d['guard'],
            'active' => (bool)($d['active'] ?? true),
        ]);

        // لو فيه صلاحيات ابعتها للسيرفس
        if (!empty($d['permissions'])) {
            $this->perms->syncRolePermissions($role, $d['permissions']);
        }

        return $this->responder->created(
            new RoleResource($role->load('permissions')->loadCount('users')),
            'Role created'
        );
    }

    /**
     * @group System / Roles
     * @authenticated
     * Update role (and replace permissions)
     *
     * يحدّث بيانات الدور ولو وصّلت مصفوفة `permissions` هيستبدل كل صلاحيات الدور بالمصفوفة الجديدة (sync).
     *
     * @urlParam id integer required Role ID. Example: 4
     * @contentType multipart/form-data
     *
     * @bodyParam name string Role display name. Example: Manager
     * @bodyParam slug string Unique slug per guard. Example: manager
     * @bodyParam guard string Auth guard. Example: api
     * @bodyParam active boolean Active flag. Example: 0
     * @bodyParam permissions int[] Replace role permissions with IDs. Example: [2,6]
     */
    public function update(UpdateRoleRequest $r, $id)
    {
        $role = Role::on('system')->find($id);
        if (!$role) return $this->responder->fail('Role not found', status:404);

        $data = $r->validated();

        // حدث الحقول الأساسية (بدون permissions)
        $role->fill(collect($data)->except('permissions')->toArray())->save();

        // لو موجود permissions اعمل sync
        if (array_key_exists('permissions', $data)) {
            $this->perms->syncRolePermissions($role, $data['permissions'] ?? []);
        }

        return $this->responder->ok(
            new RoleResource($role->load('permissions')->loadCount('users')),
            'Role updated'
        );
    }

    /**
     * @group System / Roles
     * @authenticated
     * Toggle role status
     *
     * @urlParam id integer required Role ID. Example: 4
     * @contentType multipart/form-data
     * @bodyParam active boolean required 1/0. Example: 1
     */
    public function toggle(Request $r, $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $role = Role::on('system')->find($id);
        if (!$role) return $this->responder->fail('Role not found', status:404);
        $role->active = $data['active'];
        $role->save();

        return $this->responder->ok(
            new RoleResource($role->loadCount('users')),
            'Role status updated'
        );
    }

    /**
     * @group System / Roles
     * @authenticated
     * Delete role
     *
     * @urlParam id integer required Role ID. Example: 4
     */
    public function destroy($id)
    {
        $role = Role::on('system')->find($id);
        if (!$role) return $this->responder->fail('Role not found', status:404);
        $role->delete();

        return $this->responder->ok(null, 'Role deleted');
    }

    /**
     * @group System / Roles
     * @authenticated
     * Sync role permissions
     *
     * يستبدل صلاحيات الدور بالمصفوفة المرسلة.
     *
     * @urlParam id integer required Role ID. Example: 4
     * @contentType multipart/form-data
     * @bodyParam permissions int[] required Permission IDs. Example: [1,2,3]
     */
    public function syncPermissions(Request $r, $id)
    {
        $role = Role::on('system')->find($id);
        if (!$role) return $this->responder->fail('Role not found', status:404);

        $data = $r->validate([
            'permissions'   => ['required','array'],
            'permissions.*' => ['integer','exists:system.permissions,id'],
        ]);

        $this->perms->syncRolePermissions($role, $data['permissions']);

        return $this->responder->ok(
            new RoleResource($role->load('permissions')->loadCount('users')),
            'Role permissions synced'
        );
    }
}
