<div class="space-y-3" dir="rtl">
    @if($features->isNotEmpty())
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

            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-900">
                <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $featureName }}</div>
                <div class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    {{ $featureValue }}
                </div>
            </div>
        @endforeach
    @else
        <div class="text-sm text-gray-500 dark:text-gray-400">لا توجد مميزات مسجلة لهذه الباقة.</div>
    @endif
</div>
