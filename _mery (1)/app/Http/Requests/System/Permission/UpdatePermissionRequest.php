<?php

namespace App\Http\Requests\System\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        $id = (int) $this->route('id');
        return [
            'name'   => ['sometimes','string','max:191'],
            'slug'   => ['sometimes','string','max:191', Rule::unique('system.permissions','slug')->ignore($id)->where(fn($q)=>$q->where('guard',$this->input('guard','api')))],
            'guard'  => ['sometimes','string','max:32'],
            'active' => ['sometimes','boolean'],
        ];
    }
    public function bodyParameters(): array
{
    return [
        'name'   => ['description'=>'Permission display name','example'=>'Create User'],
        'slug'   => ['description'=>'Unique slug','example'=>'system.users.store'],
        'guard'  => ['description'=>'Auth guard','example'=>'api'],
        'active' => ['description'=>'Active flag','example'=>false],
    ];
}

}
