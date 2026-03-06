<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="mt-6 flex justify-end">
            <button
                type="submit"
                class="fi-btn fi-color-primary fi-size-md inline-grid min-w-[theme(spacing.20)] cursor-pointer grid-flow-col items-center justify-center gap-1.5 rounded-lg px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-inset transition duration-75 focus:outline-none bg-primary-600 text-white ring-primary-600/10 hover:bg-primary-500"
            >
                حفظ
            </button>
        </div>
    </form>
</x-filament-panels::page>
