<?php

namespace App\Http\Requests\System\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = (int) $this->route('id');

        return [
            'name'     => ['sometimes','string','max:191'],
            'email'    => ['sometimes','email','max:191', Rule::unique('system.users','email')->ignore($id)],
            'phone'    => ['sometimes','nullable','string','max:30'],
            'password' => ['sometimes','nullable','string','min:6','max:191'],
            'guard'    => ['sometimes','string','max:32'],
            'active'   => ['sometimes','boolean'],

            // استبدال الأدوار
            'roles'    => ['sometimes','array'],
            'roles.*'  => ['integer','exists:system.roles,id'],

            // اختصار لدور واحد (هتحوله داخليًا لـ roles = [role_id])
            'role_id'  => ['sometimes','integer','exists:system.roles,id'],
        ];
    }

    // Scribe
    public function bodyParameters(): array
    {
        return [
            'name' => ['description'=>'Full name','example'=>'Ahmed Updated'],
            'email'=> ['description'=>'Unique email','example'=>'admin2@example.com'],
            'phone'=> ['description'=>'Phone','example'=>'+201111111111'],
            'password'=> ['description'=>'New password (optional)','example'=>'newpass123'],
            'guard'=> ['description'=>'Auth guard','example'=>'api'],
            'active'=> ['description'=>'Active flag','example'=>false],
            'roles' => ['description'=>'Replace roles with these IDs','example'=>[2]],
            'role_id' => ['description'=>'Single role ID (shortcut). If present, will be merged into roles[] or replace when roles not provided','example'=>3],
        ];
    }
}
