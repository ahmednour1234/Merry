<x-filament-panels::page>
    <form wire:submit="authenticate">
        {{ $this->form }}

        <x-filament::button
            type="submit"
            class="w-full"
        >
            تسجيل الدخول
        </x-filament::button>

        <div class="mt-4 text-center">
            <a
                href="{{ \Filament\Facades\Filament::getPanel('office')->getRegistrationUrl() }}"
                class="text-sm text-primary-600 hover:text-primary-700"
            >
                ليس لديك حساب؟ إنشاء حساب جديد
            </a>
        </div>
    </form>
</x-filament-panels::page>
