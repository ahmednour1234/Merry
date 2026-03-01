<x-filament-panels::page.simple>
    <x-filament-panels::form wire:submit="authenticate">
        {{ $this->form }}

        <x-filament::button
            type="submit"
            class="w-full"
        >
            تسجيل الدخول
        </x-filament::button>
    </x-filament-panels::form>

    <x-slot name="subheading">
        <a
            href="{{ \App\Filament\Office\Pages\Auth\Register::getUrl() }}"
            class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300"
        >
            ليس لديك حساب؟ إنشاء حساب جديد
        </a>
    </x-slot>
</x-filament-panels::page.simple>
