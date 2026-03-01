<x-filament-panels::page.simple>
    <x-filament-panels::form wire:submit="register">
        {{ $this->form }}

        <x-filament::button
            type="submit"
            class="w-full"
        >
            إنشاء حساب
        </x-filament::button>
    </x-filament-panels::form>

    <x-slot name="subheading">
        <a
            href="{{ \App\Filament\Office\Pages\Auth\Login::getUrl() }}"
            class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300"
        >
            لديك حساب بالفعل؟ تسجيل الدخول
        </a>
    </x-slot>
</x-filament-panels::page.simple>
