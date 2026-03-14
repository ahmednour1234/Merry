<div class="space-y-6" dir="rtl">
    @php
        $currentSubscription = $this->getCurrentSubscription();
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

        {{ $this->table }}
    </x-filament::section>
</div>
