<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\System\User\StoreUserRequest;
use App\Http\Requests\System\User\UpdateUserRequest;
use App\Http\Resources\System\UserResource;
use App\Repositories\System\Contracts\UserRepositoryInterface as Repo;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    public function __construct(protected Repo $repo)
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * @group System / Users
     * @authenticated
     * List users with filters
     *
     * @queryParam name string Example: Ahmed
     * @queryParam email string Example: admin@example.com
     * @queryParam active boolean Example: 1
     * @queryParam guard string Example: api
     * @queryParam role string Role slug/name/id. Example: admin
     * @queryParam from date Example: 2025-01-01
     * @queryParam to date Example: 2025-12-31
     * @queryParam per_page integer Example: 15
     */
    public function index(Request $r)
    {
        $filters = $r->only(['name','email','active','guard','role','from','to']);
        $per = (int) $r->integer('per_page', 15);
        $p = $this->repo->paginate($filters, $per > 0 ? $per : 15);

        return $this->responder->paginated($p, UserResource::class, 'Users');
    }

    /**
     * @group System / Users
     * @authenticated
     * Create user (and attach roles)
     *
     * يقبل roles[] أو role_id (اختصار لدور واحد).
     */
    public function store(StoreUserRequest $r)
    {
        $data = $r->validated();

        // تطبيع: لو جالي role_id استخدمه بدل/مع roles[]
        if (!empty($data['role_id'])) {
            $data['roles'] = array_values(array_unique(array_merge(
                (array)($data['roles'] ?? []),
                [(int)$data['role_id']]
            )));
            unset($data['role_id']);
        }

        $row = $this->repo->store($data);

        return $this->responder->created(
            new UserResource($row->load('roles')),
            'User created'
        );
    }

    /**
     * @group System / Users
     * @authenticated
     * Update user (and sync roles if provided)
     *
     * يقبل roles[] أو role_id (هيستبدّل الأدوار لو المصفوفة موجودة/مُشتقّة من role_id).
     */
    public function update(int $id, UpdateUserRequest $r)
    {
        $data = $r->validated();

        if (array_key_exists('role_id', $data)) {
            // لو role_id مبعوت—even إن roles مش مبعوتة—نحوّله إلى roles = [role_id]
            $data['roles'] = isset($data['roles'])
                ? array_values(array_unique(array_merge((array)$data['roles'], [(int)$data['role_id']])))
                : [(int)$data['role_id']];
            unset($data['role_id']);
        }

        $row = $this->repo->update($id, $data);
        if (!$row) return $this->responder->fail('User not found', status:404);

        return $this->responder->ok(
            new UserResource($row->load('roles')),
            'User updated'
        );
    }

    /**
     * @group System / Users
     * @authenticated
     * Soft delete user
     */
    public function destroy(int $id)
    {
        $ok = $this->repo->destroy($id);
        return $ok
            ? $this->responder->ok(null, 'User deleted')
            : $this->responder->fail('User not found', status:404);
    }

    /**
     * @group System / Users
     * @authenticated
     * Toggle active
     * @bodyParam active boolean required Example: 1
     */
    public function toggle(Request $r, int $id)
    {
        $data = $r->validate(['active'=>'required|boolean']);
        $row = $this->repo->toggle($id, (bool)$data['active']);
        if (!$row) return $this->responder->fail('User not found', status:404);
        return $this->responder->ok(new UserResource($row), 'User status updated');
    }

    /**
     * @group System / Users
     * @authenticated
     * Sync roles
     * @bodyParam roles array required List of role IDs. Example: [1,2]
     */
    public function syncRoles(Request $r, $id) // تسيبها بدون typehint علشان مشاكل سابقة
    {
        $data = $r->validate([
            'roles'   => ['required','array'],
            'roles.*' => ['integer','exists:system.roles,id'],
        ]);

        $row = $this->repo->syncRoles((int)$id, $data['roles']);
        if (!$row) return $this->responder->fail('User not found', status:404);

        return $this->responder->ok(new UserResource($row->load('roles')), 'User roles synced');
    }
}
