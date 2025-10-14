<?php

namespace App\Http\Requests\System\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = (int) $this->route('id');
        return [
            'name'   => ['sometimes','string','max:191'],
            'slug'   => ['sometimes','string','max:191', Rule::unique('system.roles','slug')->ignore($id)->where(fn($q)=>$q->where('guard',$this->input('guard','api')))],
            'guard'  => ['sometimes','string','max:32'],
            'active' => ['sometimes','boolean'],
        ];
    }
    public function bodyParameters(): array
{
    return [
        'name'   => ['description'=>'Role display name','example'=>'Manager'],
        'slug'   => ['description'=>'Unique slug per guard','example'=>'manager'],
        'guard'  => ['description'=>'Auth guard','example'=>'api'],
        'active' => ['description'=>'Active flag','example'=>false],
        'permissions'=> ['description'=>'Replace role permissions with IDs','example'=>[1,3,5]],
    ];
}

}
