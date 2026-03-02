<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            المستخدمين الذين أضافوا ملفاتك للمفضلة
        </x-slot>
        <x-slot name="description">
            أعلى 10 مستخدمين أضافوا سيرك الذاتية للمفضلة
        </x-slot>

        <div class="space-y-2">
            @forelse($this->getViewData()['users'] as $user)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <span class="font-medium text-gray-900 dark:text-white">{{ $user['user_name'] }}</span>
                    <span class="px-3 py-1 bg-success-100 dark:bg-success-900 text-success-700 dark:text-success-300 rounded-full text-sm font-semibold">
                        {{ $user['count'] }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">لا توجد بيانات</p>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
