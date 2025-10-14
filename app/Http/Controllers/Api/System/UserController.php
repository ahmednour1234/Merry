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
     * List users with filters.
     * @queryParam name string
     * @queryParam email string
     * @queryParam active boolean
     * @queryParam guard string
     * @queryParam role string Role slug/name/id
     * @queryParam from date
     * @queryParam to date
     * @queryParam per_page integer
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
     * Create user (and attach roles).
     */
    public function store(StoreUserRequest $r)
    {
        $row = $this->repo->store($r->validated());
        return $this->responder->created(new UserResource($row->load('roles')), 'User created');
    }

    /**
     * @group System / Users
     * Update user (and sync roles if provided).
     */
    public function update(int $id, UpdateUserRequest $r)
    {
        $row = $this->repo->update($id, $r->validated());
        if (!$row) return $this->responder->fail('User not found', status:404);
        return $this->responder->ok(new UserResource($row->load('roles')), 'User updated');
    }

    /**
     * @group System / Users
     * Soft delete user.
     */
    public function destroy(int $id)
    {
        $ok = $this->repo->destroy($id);
        return $ok ? $this->responder->ok(null, 'User deleted') : $this->responder->fail('User not found', status:404);
    }

    /**
     * @group System / Users
     * Toggle active.
     * @bodyParam active boolean required
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
     * Sync roles.
     * @bodyParam roles array required List of role IDs.
     */
// ...
public function syncRoles(Request $r, $id) // <-- شيل typehint عشان ما يرميش BadType
{
    $data = $r->validate([
        'roles'   => ['required','array'],
        'roles.*' => ['integer','exists:system.roles,id'],
    ]);

    $row = $this->repo->syncRoles((int)$id, $data['roles']); // <-- cast هنا
    if (!$row) return $this->responder->fail('User not found', status:404);

    return $this->responder->ok(new UserResource($row->load('roles')), 'User roles synced');
}

}
