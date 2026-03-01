<x-filament-panels::page>
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">الإشعارات</h2>
            <form method="POST" action="{{ route('filament.office.pages.notifications.read-all') }}">
                @csrf
                <x-filament::button type="submit" color="primary" size="sm">
                    تحديد الكل كمقروء
                </x-filament::button>
            </form>
        </div>

        {{ $this->table }}
    </div>
</x-filament-panels::page>
