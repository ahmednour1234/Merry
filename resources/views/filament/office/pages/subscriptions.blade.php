<div class="space-y-6">
    @php
        $currentSubscription = $this->getCurrentSubscription();
        $plans = $this->getPlans();
    @endphp

        @if($currentSubscription)
            <x-filament::section>
                <x-slot name="heading">
                    الاشتراك الحالي
                </x-slot>

                <div class="space-y-4">
                    @php
                        $planName = $currentSubscription->plan->translations->where('lang_code', 'ar')->first()?->name
                            ?? $currentSubscription->plan->translations->first()?->name
                            ?? $currentSubscription->plan->name;
                        $daysLeft = now()->diffInDays($currentSubscription->ends_at, false);
                    @endphp

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-semibold">{{ $planName }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                ينتهي في: {{ $currentSubscription->ends_at->format('Y-m-d') }}
                                @if($daysLeft > 0)
                                    ({{ $daysLeft }} يوم متبقي)
                                @else
                                    (منتهي)
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center gap-4">
                            <x-filament::toggle
                                :checked="$currentSubscription->auto_renew"
                                wire:click="toggleAutoRenew({{ $currentSubscription->id }})"
                                label="التجديد التلقائي"
                            />
                        </div>
                    </div>
                </div>
            </x-filament::section>
        @endif

        <x-filament::section>
            <x-slot name="heading">
                الخطط المتاحة
            </x-slot>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($plans as $plan)
                    <div class="rounded-lg border p-6 {{ $plan['is_current'] ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20' : 'border-gray-200 dark:border-gray-700' }}">
                        @if($plan['is_current'])
                            <div class="mb-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800 dark:bg-primary-900 dark:text-primary-200">
                                    الخطة الحالية
                                </span>
                            </div>
                        @endif

                        <h3 class="text-xl font-bold mb-2">{{ $plan['name'] }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $plan['description'] }}</p>

                        <div class="mb-4">
                            <span class="text-3xl font-bold">{{ number_format($plan['final_price'], 2) }}</span>
                            <span class="text-gray-600 dark:text-gray-400">{{ $plan['currency'] }}</span>
                            <span class="text-sm text-gray-500">/ {{ $plan['billing_cycle'] === 'annual' ? 'سنة' : 'شهر' }}</span>
                        </div>

                        @if($plan['features']->isNotEmpty())
                            <ul class="space-y-2 mb-6">
                                @foreach($plan['features'] as $feature)
                                    <li class="flex items-center gap-2 text-sm">
                                        <x-filament::icon icon="heroicon-o-check" class="h-4 w-4 text-success-600" />
                                        <span>{{ $feature['key'] }}: {{ $feature['limit'] ?? $feature['value'] ?? 'متاح' }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if(!$plan['is_current'])
                            <x-filament::button
                                wire:click="subscribe('{{ $plan['code'] }}')"
                                color="primary"
                                class="w-full"
                            >
                                الاشتراك
                            </x-filament::button>
                        @else
                            <x-filament::button
                                disabled
                                class="w-full"
                            >
                                مشترك حالياً
                            </x-filament::button>
                        @endif
                    </div>
                @endforeach
            </div>
        </x-filament::section>
</div>
