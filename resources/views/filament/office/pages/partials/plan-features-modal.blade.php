<div class="space-y-3" dir="rtl">
    @if($features->isNotEmpty())
        @foreach($features as $feature)
            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-900">
                <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $feature->feature_key }}</div>
                <div class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    {{ $feature->limit ?? $feature->value ?? 'متاح' }}
                </div>
            </div>
        @endforeach
    @else
        <div class="text-sm text-gray-500 dark:text-gray-400">لا توجد مميزات مسجلة لهذه الباقة.</div>
    @endif
</div>
