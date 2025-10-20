<?php

namespace App\Http\Requests\System\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'     => ['required','string','max:191'],
            'email'    => ['required','email','max:191','unique:system.users,email'],
            'phone'    => ['nullable','string','max:30'],
            'password' => ['required','string','min:6','max:191'],
            'guard'    => ['nullable','string','max:32'],
            'active'   => ['nullable','boolean'],

            // أدوار
            'roles'    => ['nullable','array'],
            'roles.*'  => ['integer','exists:system.roles,id'],

            // اختصار لدور واحد
            'role_id'  => ['nullable','integer','exists:system.roles,id'],
        ];
    }

    // Scribe
    public function bodyParameters(): array
    {
        return [
            'name' => ['description'=>'Full name','example'=>'Ahmed Ali'],
            'email'=> ['description'=>'Unique email','example'=>'admin@example.com'],
            'phone'=> ['description'=>'Optional phone','example'=>'+201001234567'],
            'password'=> ['description'=>'Password (min 6)','example'=>'secret123'],
            'guard'=> ['description'=>'Auth guard','example'=>'api'],
            'active'=> ['description'=>'Active flag','example'=>true],
            'roles' => ['description'=>'Role IDs to attach','example'=>[1,2]],
            'role_id' => ['description'=>'Single role ID (shortcut). If sent, it will be merged into roles[]','example'=>1],
        ];
    }
}
