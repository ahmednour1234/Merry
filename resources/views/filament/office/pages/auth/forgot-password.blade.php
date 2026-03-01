<x-filament-panels::page.simple>
    <form wire:submit="submit">
        {{ $this->form }}

        <x-filament::button type="submit" class="w-full">
            إرسال رمز الاستعادة
        </x-filament::button>
    </form>
</x-filament-panels::page.simple>
