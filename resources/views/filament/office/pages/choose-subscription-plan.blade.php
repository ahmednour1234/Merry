<div class="space-y-6" dir="rtl">
    @php
        $currentSubscription = $this->getCurrentSubscription();
        $plans = $this->getPlans();
    @endphp

    <x-filament::section>
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200 dark:bg-gray-900 dark:ring-white/10">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-2xl font-black text-gray-950 dark:text-white">اختيار الباقة</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">اختر الباقة المناسبة، ثم اضغط على عرض المميزات لمعرفة التفاصيل قبل الاشتراك.</p>
                </div>
                <x-filament::button
                    tag="a"
                    :href="\App\Filament\Office\Resources\SubscriptionResource::getUrl()"
                    color="gray"
                >
                    الرجوع إلى الاشتراكات
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>

    @if($currentSubscription)
        @php
            $planName = $currentSubscription->plan->translations->where('lang_code', 'ar')->first()?->name
                ?? $currentSubscription->plan->translations->first()?->name
                ?? $currentSubscription->plan->name;
        @endphp

        <x-filament::section>
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900/30 dark:bg-emerald-900/20 dark:text-emerald-200">
                الباقة الحالية: <span class="font-bold">{{ $planName }}</span>
                <span class="mx-2">|</span>
                تنتهي في: <span class="font-bold">{{ $currentSubscription->ends_at->format('Y-m-d') }}</span>
            </div>
        </x-filament::section>
    @endif

    <x-filament::section>
        <x-slot name="heading">الباقات المتاحة</x-slot>

        <div x-data="{ expanded: null }" class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800/70">
                        <tr>
                            <th class="px-4 py-4 text-right text-sm font-bold text-gray-700 dark:text-gray-200">الباقة</th>
                            <th class="px-4 py-4 text-right text-sm font-bold text-gray-700 dark:text-gray-200">الوصف</th>
                            <th class="px-4 py-4 text-right text-sm font-bold text-gray-700 dark:text-gray-200">السعر</th>
                            <th class="px-4 py-4 text-right text-sm font-bold text-gray-700 dark:text-gray-200">الدورة</th>
                            <th class="px-4 py-4 text-right text-sm font-bold text-gray-700 dark:text-gray-200">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($plans as $plan)
                            @php
                                $isCurrent = (bool) ($plan['is_current'] ?? false);
                                $billing = ($plan['billing_cycle'] ?? 'monthly') === 'annual' ? 'سنوي' : 'شهري';
                                $features = $plan['features'] ?? collect();
                                $planCode = (string) $plan['code'];
                            @endphp

                            <tr class="align-top {{ $isCurrent ? 'bg-emerald-50/70 dark:bg-emerald-900/10' : '' }}">
                                <td class="px-4 py-4 text-sm text-gray-900 dark:text-white">
                                    <div class="font-bold">{{ $plan['name'] }}</div>
                                    @if($isCurrent)
                                        <div class="mt-1 inline-flex rounded-full bg-emerald-100 px-2 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">الباقة الحالية</div>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $plan['description'] ?: 'لا يوجد وصف' }}</td>
                                <td class="px-4 py-4 text-sm font-bold text-gray-900 dark:text-white">{{ number_format((float) $plan['final_price'], 2) }} {{ $plan['currency'] }}</td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $billing }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <x-filament::button
                                            type="button"
                                            color="gray"
                                            size="sm"
                                            x-on:click="expanded = expanded === @js($planCode) ? null : @js($planCode)"
                                        >
                                            عرض المميزات
                                        </x-filament::button>

                                        @if(!$isCurrent)
                                            <x-filament::button
                                                wire:click="subscribe('{{ $planCode }}')"
                                                color="success"
                                                size="sm"
                                            >
                                                اشتراك
                                            </x-filament::button>
                                        @else
                                            <x-filament::button disabled size="sm">
                                                مشترك حاليًا
                                            </x-filament::button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr x-show="expanded === @js($planCode)" x-collapse style="display: none;">
                                <td colspan="5" class="bg-gray-50 px-4 py-4 dark:bg-gray-800/60">
                                    @if(collect($features)->isNotEmpty())
                                        <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-3">
                                            @foreach($features as $feature)
                                                <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-900">
                                                    <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $feature['key'] }}</div>
                                                    <div class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                                        {{ $feature['limit'] ?? $feature['value'] ?? 'متاح' }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-sm text-gray-500 dark:text-gray-400">لا توجد مميزات مسجلة لهذه الباقة.</div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-filament::section>
</div>
