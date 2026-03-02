<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            الجنسيات الأكثر طلباً
        </x-slot>
        <x-slot name="description">
            الجنسيات التي عليها طلبات حجز أكثر
        </x-slot>

        <div class="space-y-2">
            @forelse($this->getViewData()['nationalities'] as $nationality)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <span class="font-medium text-gray-900 dark:text-white">{{ $nationality['name'] }}</span>
                    <span class="px-3 py-1 bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300 rounded-full text-sm font-semibold">
                        {{ $nationality['count'] }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">لا توجد بيانات</p>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
