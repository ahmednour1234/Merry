<?php

namespace App\Http\Requests\System\City;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        // translations: كائن { "ar":"الرياض", "en":"Riyadh" }
        return [
            'slug'          => ['nullable','string','max:191','unique:system.cities,slug'],
            'country_code'  => ['nullable','string','size:2'],
            'active'        => ['nullable','boolean'],
            'translations'  => ['required','array','min:1'],
            'translations.*'=> ['required','string','max:191'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'slug'         => ['description'=>'Unique slug (optional, auto from name if missing)','example'=>'riyadh'],
            'country_code' => ['description'=>'ISO-2','example'=>'SA'],
            'active'       => ['description'=>'Active flag','example'=>true],
            'translations' => ['description'=>'Map of lang_code => name','example'=>['ar'=>'الرياض','en'=>'Riyadh']],
        ];
    }
}
