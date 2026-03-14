<div class="space-y-4" dir="rtl">
    @if($features->isNotEmpty())
        <div class="flex items-center justify-between rounded-xl bg-gray-50 px-3 py-2 text-xs text-gray-600 dark:bg-gray-800/60 dark:text-gray-300">
            <span>إجمالي المميزات</span>
            <span class="rounded-full bg-primary-600/10 px-2.5 py-1 font-bold text-primary-700 dark:text-primary-300">{{ $features->count() }}</span>
        </div>

        <div class="grid gap-3 sm:grid-cols-2">
        @foreach($features as $feature)
            @php
                $translations = [
                    'cv.limit' => 'عدد السير الذاتية المسموح',
                    'orders.limit' => 'عدد الطلبات المسموح',
                    'support.priority' => 'أولوية الدعم',
                    'upload.allowed' => 'السماح بالرفع',
                ];

                $featureName = $translations[$feature->feature_key] ?? $feature->feature_key;
                $featureValue = $feature->limit ?? $feature->value;

                if (in_array($feature->feature_key, ['support.priority', 'upload.allowed'], true)) {
                    $featureValue = (string) $featureValue === '1' ? 'نعم' : 'لا';
                }

                if ($featureValue === null || $featureValue === '') {
                    $featureValue = 'متاح';
                }
            @endphp

            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $featureName }}</div>
                <div class="mt-2 inline-flex rounded-lg bg-gray-100 px-2.5 py-1 text-sm font-semibold text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                    {{ is_array($featureValue) ? json_encode($featureValue, JSON_UNESCAPED_UNICODE) : $featureValue }}
                </div>
            </div>
        @endforeach
        </div>
    @else
        <div class="rounded-xl border border-dashed border-gray-300 px-4 py-6 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400">
            لا توجد مميزات مسجلة لهذه الباقة.
        </div>
    @endif
</div>
