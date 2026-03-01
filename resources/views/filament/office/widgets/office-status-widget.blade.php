<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            حالة المكتب
        </x-slot>

        <div class="space-y-4">
            @if(!$isActive || $isBlocked)
                <div class="rounded-lg p-4 bg-{{ $statusColor }}-50 dark:bg-{{ $statusColor }}-900/20 border border-{{ $statusColor }}-200 dark:border-{{ $statusColor }}-800">
                    <div class="flex items-center gap-3">
                        <x-filament::icon
                            icon="heroicon-o-exclamation-triangle"
                            class="h-6 w-6 text-{{ $statusColor }}-600 dark:text-{{ $statusColor }}-400"
                        />
                        <div>
                            <p class="font-semibold text-{{ $statusColor }}-900 dark:text-{{ $statusColor }}-100">
                                {{ $statusText }}
                            </p>
                            @if(!$isActive)
                                <p class="text-sm text-{{ $statusColor }}-700 dark:text-{{ $statusColor }}-300 mt-1">
                                    حسابك قيد المراجعة. سيتم إشعارك عند تفعيل الحساب.
                                </p>
                            @endif
                            @if($isBlocked)
                                <p class="text-sm text-{{ $statusColor }}-700 dark:text-{{ $statusColor }}-300 mt-1">
                                    تم حظر حسابك. يرجى التواصل مع الإدارة.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="rounded-lg p-4 bg-success-50 dark:bg-success-900/20 border border-success-200 dark:border-success-800">
                    <div class="flex items-center gap-3">
                        <x-filament::icon
                            icon="heroicon-o-check-circle"
                            class="h-6 w-6 text-success-600 dark:text-success-400"
                        />
                        <div>
                            <p class="font-semibold text-success-900 dark:text-success-100">
                                حسابك نشط
                            </p>
                            <p class="text-sm text-success-700 dark:text-success-300 mt-1">
                                يمكنك الآن استخدام جميع الميزات المتاحة.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
