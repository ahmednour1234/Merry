<x-filament-panels::page.simple>
    <form wire:submit="authenticate">
        {{ $this->form }}

        <x-filament::button type="submit" class="w-full">
            تسجيل الدخول
        </x-filament::button>
    </form>
</x-filament-panels::page.simple>
