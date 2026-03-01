<x-filament-panels::page>
    <form wire:submit="verify">
        {{ $this->form }}

        <x-filament::button
            type="submit"
            class="w-full"
        >
            التحقق
        </x-filament::button>

        <div class="mt-4 text-center">
            <x-filament::button
                type="button"
                wire:click="resendOtp"
                color="gray"
                variant="link"
            >
                إعادة إرسال الرمز
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
