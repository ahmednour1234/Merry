<?php

namespace App\Http\Requests\System\InsuranceCompany;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInsuranceCompanyRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'    => ['sometimes','string','max:191'],
            'website' => ['sometimes','nullable','url','max:191'],
            'logo'    => ['sometimes','nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'active'  => ['sometimes','boolean'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name'    => ['description'=>'Company name','example'=>'ABC Insurance Updated'],
            'website' => ['description'=>'Website URL','example'=>'https://abc-ins.com/about'],
            'logo'    => ['description'=>'Image file (jpg/png/webp)','example'=>'(binary file)'],
            'active'  => ['description'=>'Active flag','example'=>false],
        ];
    }
}
