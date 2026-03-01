<x-filament-panels::page>
    <form wire:submit="register">
        {{ $this->form }}

        <x-filament::button
            type="submit"
            class="w-full"
        >
            إنشاء حساب
        </x-filament::button>

        <div class="mt-4 text-center">
            <a
                href="{{ \Filament\Facades\Filament::getPanel('office')->getLoginUrl() }}"
                class="text-sm text-primary-600 hover:text-primary-700"
            >
                لديك حساب بالفعل؟ تسجيل الدخول
            </a>
        </div>
    </form>
</x-filament-panels::page>
