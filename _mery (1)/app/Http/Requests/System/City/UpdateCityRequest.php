<?php

namespace App\Http\Requests\System\City;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = (int) $this->route('id');
        return [
            'slug'          => ['sometimes','nullable','string','max:191',"unique:system.cities,slug,{$id}"],
            'country_code'  => ['sometimes','nullable','string','size:2'],
            'active'        => ['sometimes','boolean'],
            'translations'  => ['sometimes','array'],
            'translations.*'=> ['required_with:translations','string','max:191'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'slug'         => ['description'=>'Unique slug','example'=>'riyadh'],
            'country_code' => ['description'=>'ISO-2','example'=>'SA'],
            'active'       => ['description'=>'Active flag','example'=>false],
            'translations' => ['description'=>'Map of lang_code => name','example'=>['ar'=>'الرياض','en'=>'Riyadh']],
        ];
    }
}
