<div class="space-y-6" dir="rtl">
    @php
        $currentSubscription = $this->getCurrentSubscription();
        $plans = $this->getPlans();
    @endphp

    <x-filament::section>
        <div class="rounded-3xl bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-500 px-6 py-8 text-white shadow-xl ring-1 ring-white/20 md:px-10 md:py-10">
            <div class="space-y-3 text-center">
                <h2 class="text-3xl font-black tracking-tight md:text-4xl">نظام ميري للاستخدام</h2>
                <p class="text-base text-emerald-50/95 md:text-lg">إدارة اشتراكاتك بسهولة واختيار الخطة الأنسب لاحتياج مكتبك</p>
            </div>
            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/25 backdrop-blur-sm">
                    <p class="text-xs text-emerald-50/90">إجمالي الخطط</p>
                    <p class="mt-2 text-2xl font-extrabold">{{ $plans->count() }}</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/25 backdrop-blur-sm">
                    <p class="text-xs text-emerald-50/90">اشتراك نشط</p>
                    <p class="mt-2 text-2xl font-extrabold">{{ $currentSubscription ? '1' : '0' }}</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/25 backdrop-blur-sm">
                    <p class="text-xs text-emerald-50/90">التجديد التلقائي</p>
                    <p class="mt-2 text-2xl font-extrabold">{{ $currentSubscription?->auto_renew ? 'مفعل' : 'غير مفعل' }}</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/25 backdrop-blur-sm">
                    <p class="text-xs text-emerald-50/90">الخطة الحالية</p>
                    <p class="mt-2 truncate text-lg font-bold">{{ $currentSubscription?->plan?->code ?? 'لا يوجد' }}</p>
                </div>
            </div>
        </div>
    </x-filament::section>

    @if($currentSubscription)
        @php
            $planName = $currentSubscription->plan->translations->where('lang_code', 'ar')->first()?->name
                ?? $currentSubscription->plan->translations->first()?->name
                ?? $currentSubscription->plan->name;
            $daysLeft = now()->diffInDays($currentSubscription->ends_at, false);
            $statusText = $daysLeft > 0 ? 'نشط' : 'منتهي';
        @endphp

        <x-filament::section>
            <x-slot name="heading">الاشتراك الحالي</x-slot>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                    <p class="text-xs text-gray-500">الخطة</p>
                    <p class="mt-2 text-xl font-extrabold text-gray-900 dark:text-white">{{ $planName }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                    <p class="text-xs text-gray-500">ينتهي في</p>
                    <p class="mt-2 text-lg font-bold text-gray-900 dark:text-white">{{ $currentSubscription->ends_at->format('Y-m-d') }}</p>
                    <p class="mt-1 text-sm text-gray-500">{{ $daysLeft > 0 ? $daysLeft . ' يوم متبقي' : 'منتهي' }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                    <p class="text-xs text-gray-500">حالة الاشتراك</p>
                    <div class="mt-2 flex items-center justify-between gap-3">
                        <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">{{ $statusText }}</span>
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
        <x-slot name="heading">الخطط المتاحة</x-slot>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach($plans as $plan)
                @php
                    $isCurrent = (bool) ($plan['is_current'] ?? false);
                    $billing = ($plan['billing_cycle'] ?? 'monthly') === 'annual' ? 'سنوي' : 'شهري';
                    $features = $plan['features'] ?? collect();
                @endphp

                <div class="flex h-full flex-col rounded-3xl border bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:bg-gray-900 {{ $isCurrent ? 'border-emerald-500 ring-2 ring-emerald-100 dark:ring-emerald-900/30' : 'border-gray-200 dark:border-gray-700' }}">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $plan['name'] }}</h3>
                        @if($isCurrent)
                            <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">الخطة الحالية</span>
                        @endif
                    </div>

                    <p class="min-h-[3rem] text-sm text-gray-600 dark:text-gray-300">{{ $plan['description'] }}</p>

                    <div class="my-5 rounded-2xl bg-gray-50 p-4 text-center dark:bg-gray-800/70">
                        <div class="text-3xl font-black text-gray-900 dark:text-white">{{ number_format((float) $plan['final_price'], 2) }}</div>
                        <div class="mt-1 text-sm text-gray-500">{{ $plan['currency'] }} / {{ $billing }}</div>
                    </div>

                    @if($features->isNotEmpty())
                        <ul class="mb-6 space-y-2">
                            @foreach($features as $feature)
                                <li class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-200">
                                    <x-filament::icon icon="heroicon-o-check-circle" class="mt-0.5 h-4 w-4 text-emerald-600" />
                                    <span>{{ $feature['key'] }}: {{ $feature['limit'] ?? $feature['value'] ?? 'متاح' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mt-auto">
                        @if(!$isCurrent)
                            <x-filament::button
                                wire:click="subscribe('{{ $plan['code'] }}')"
                                color="success"
                                class="w-full"
                            >
                                الاشتراك في هذه الخطة
                            </x-filament::button>
                        @else
                            <x-filament::button disabled class="w-full">مشترك حالياً</x-filament::button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</div>
