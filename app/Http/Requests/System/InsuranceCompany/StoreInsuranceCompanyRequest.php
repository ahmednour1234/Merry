<?php

namespace App\Http\Requests\System\InsuranceCompany;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsuranceCompanyRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'    => ['required','string','max:191'],
            'website' => ['nullable','url','max:191'],
            'logo'    => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'active'  => ['nullable','boolean'],
        ];
    }

    // Scribe docs
    public function bodyParameters(): array
    {
        return [
            'name'    => ['description'=>'Company name','example'=>'ABC Insurance'],
            'website' => ['description'=>'Website URL','example'=>'https://abc-ins.com'],
            'logo'    => ['description'=>'Image file (jpg/png/webp)','example'=>'(binary file)'],
            'active'  => ['description'=>'Active flag','example'=>true],
        ];
    }
}
