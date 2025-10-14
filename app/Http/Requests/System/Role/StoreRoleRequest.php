<?php

namespace App\Http\Requests\System\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'   => ['required','string','max:191'],
            'slug'   => ['required','string','max:191', Rule::unique('system.roles','slug')->where(fn($q)=>$q->where('guard',$this->input('guard','api')))],
            'guard'  => ['required','string','max:32'],
            'active' => ['nullable','boolean'],
        ];
    }
    public function bodyParameters(): array
{
    return [
        'name'   => ['description'=>'Role display name','example'=>'Admin'],
        'slug'   => ['description'=>'Unique slug per guard','example'=>'admin'],
        'guard'  => ['description'=>'Auth guard','example'=>'api'],
        'active' => ['description'=>'Active flag','example'=>true],
    ];
}

}
