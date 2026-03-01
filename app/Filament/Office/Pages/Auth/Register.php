<?php

namespace App\Filament\Office\Pages\Auth;

use App\Models\City;
use App\Models\Office;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Support\Uploads\ImageUploader;
use Livewire\WithFileUploads;

class Register extends Page
{
    use WithFileUploads;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'register';

    protected string $view = 'filament.office.pages.auth.register';

    public $name = '';
    public $commercial_reg_no = '';
    public $city_id = null;
    public $address = '';
    public $phone = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $image;

    public $cities = [];

    public function mount(): void
    {
        if (Auth::guard('office-panel')->check()) {
            redirect()->intended(\Filament\Facades\Filament::getPanel('office')->getUrl());
        }

        $this->loadCities();
    }

    protected function loadCities(): void
    {
        $this->cities = City::on('system')->with('translations')->active()->get()->map(function ($city) {
            $name = $city->translations->where('lang_code', 'ar')->first()?->name ?? $city->translations->first()?->name ?? $city->slug;
            return [
                'id' => $city->id,
                'name' => $name,
            ];
        })->toArray();
    }

    public function register(): void
    {
        $this->validate([
            'name' => 'required|string|max:191',
            'commercial_reg_no' => 'required|string|max:191|unique:system.offices,commercial_reg_no',
            'city_id' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:32',
            'email' => 'required|email|max:191|unique:system.offices,email',
            'password' => ['required', 'string', Password::min(6), 'confirmed'],
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'اسم المكتب مطلوب',
            'commercial_reg_no.required' => 'رقم السجل التجاري مطلوب',
            'commercial_reg_no.unique' => 'رقم السجل التجاري مستخدم بالفعل',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
            'image.image' => 'يجب أن تكون الملف صورة',
            'image.mimes' => 'نوع الصورة يجب أن يكون: jpg, jpeg, png, webp',
            'image.max' => 'حجم الصورة يجب أن يكون أقل من 2MB',
        ]);

        $data = [
            'name' => $this->name,
            'commercial_reg_no' => $this->commercial_reg_no,
            'city_id' => $this->city_id,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'active' => false,
            'blocked' => false,
        ];

        if ($this->phone && !str_starts_with($this->phone, '+966')) {
            $data['phone'] = '+966' . ltrim($this->phone, '0');
        }

        if ($this->image) {
            $data['image'] = ImageUploader::upload($this->image, 'offices');
        } else {
            $data['image'] = null;
        }

        $office = Office::on('system')->create($data);

        Auth::guard('office-panel')->login($office);

        session()->regenerate();

        redirect()->intended(\Filament\Facades\Filament::getPanel('office')->getUrl());
    }

}
