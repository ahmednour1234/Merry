<div class="space-y-4">
    <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4 bg-white dark:bg-gray-800">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">ID</label>
                <p class="text-gray-900 dark:text-white">{{ $cv->id }}</p>
            </div>

            @if($cv->category)
                <div>
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">الفئة</label>
                    <p class="text-gray-900 dark:text-white">{{ $cv->category->name ?? 'غير محدد' }}</p>
                </div>
            @endif

            @if($cv->nationality)
                <div>
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">الجنسية</label>
                    <p class="text-gray-900 dark:text-white">
                        {{ $cv->nationality->translations->where('lang_code', 'ar')->first()?->name ?? $cv->nationality->translations->first()?->name ?? $cv->nationality_code }}
                    </p>
                </div>
            @endif

            <div>
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">الجنس</label>
                <p class="text-gray-900 dark:text-white">{{ $cv->gender === 'male' ? 'ذكر' : 'أنثى' }}</p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">لديه خبرة</label>
                <p class="text-gray-900 dark:text-white">
                    @if($cv->has_experience)
                        <span class="inline-flex items-center gap-1 text-green-600">
                            <x-filament::icon icon="heroicon-o-check-circle" class="h-4 w-4" />
                            نعم
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-gray-400">
                            <x-filament::icon icon="heroicon-o-x-circle" class="h-4 w-4" />
                            لا
                        </span>
                    @endif
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">مسلم</label>
                <p class="text-gray-900 dark:text-white">
                    @if($cv->is_muslim)
                        <span class="inline-flex items-center gap-1 text-green-600">
                            <x-filament::icon icon="heroicon-o-check-circle" class="h-4 w-4" />
                            نعم
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-gray-400">
                            <x-filament::icon icon="heroicon-o-x-circle" class="h-4 w-4" />
                            لا
                        </span>
                    @endif
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">الحالة</label>
                <p class="text-gray-900 dark:text-white">
                    @php
                        $statusLabels = [
                            'pending' => 'قيد الانتظار',
                            'approved' => 'موافق عليه',
                            'rejected' => 'مرفوض',
                            'frozen' => 'مجمد',
                            'deactivated_by_office' => 'معطل',
                        ];
                        $statusColors = [
                            'pending' => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                            'frozen' => 'gray',
                            'deactivated_by_office' => 'gray',
                        ];
                    @endphp
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                        @if($statusColors[$cv->status] === 'success') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                        @elseif($statusColors[$cv->status] === 'warning') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                        @elseif($statusColors[$cv->status] === 'danger') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                        @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                        @endif">
                        {{ $statusLabels[$cv->status] ?? $cv->status }}
                    </span>
                </p>
            </div>

            @if($cv->file_path)
                <div>
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">الملف</label>
                    <p class="text-gray-900 dark:text-white">
                        <a href="{{ $cv->file_url }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 dark:text-primary-400">
                            <x-filament::icon icon="heroicon-o-document-arrow-down" class="h-4 w-4" />
                            {{ $cv->file_original_name ?? 'عرض PDF' }}
                        </a>
                    </p>
                    @if($cv->file_size)
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            الحجم: {{ number_format($cv->file_size / 1024, 2) }} KB
                        </p>
                    @endif
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        المسار: {{ $cv->file_path }}
                    </p>
                </div>
            @endif

            @if($cv->approved_at)
                <div>
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">تاريخ الموافقة</label>
                    <p class="text-gray-900 dark:text-white">{{ $cv->approved_at->format('Y-m-d H:i') }}</p>
                </div>
            @endif

            @if($cv->rejected_at)
                <div>
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">تاريخ الرفض</label>
                    <p class="text-gray-900 dark:text-white">{{ $cv->rejected_at->format('Y-m-d H:i') }}</p>
                </div>
                @if($cv->rejected_reason)
                    <div class="col-span-2">
                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">سبب الرفض</label>
                        <p class="text-gray-900 dark:text-white">{{ $cv->rejected_reason }}</p>
                    </div>
                @endif
            @endif

            <div>
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">تاريخ الإنشاء</label>
                <p class="text-gray-900 dark:text-white">{{ $cv->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>
    </div>
</div>
