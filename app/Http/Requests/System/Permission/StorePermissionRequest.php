<?php

namespace App\Http\Requests\System\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePermissionRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'name'   => ['required','string','max:191'],
            'slug'   => ['required','string','max:191', Rule::unique('system.permissions','slug')->where(fn($q)=>$q->where('guard',$this->input('guard','api')))],
            'guard'  => ['required','string','max:32'],
            'active' => ['nullable','boolean'],
        ];
    }
    public function bodyParameters(): array
{
    return [
        'name'   => ['description'=>'Permission display name','example'=>'List Users'],
        'slug'   => ['description'=>'Unique slug (module.action)','example'=>'system.users.index'],
        'guard'  => ['description'=>'Auth guard','example'=>'api'],
        'active' => ['description'=>'Active flag','example'=>true],
    ];
}

}
