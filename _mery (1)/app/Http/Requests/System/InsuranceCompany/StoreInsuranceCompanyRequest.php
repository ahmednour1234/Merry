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

        'insurance_amount' => ['nullable','numeric','min:0'],
        'currency_code'    => ['nullable','string','max:8','exists:system.currencies,code'],
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
               'insurance_amount' => ['description'=>'Insurance amount in company base currency','example'=>10000.00],
        'currency_code'    => ['description'=>'Currency code (from currencies.code)','example'=>'EGP'],
        ];
    }
}
