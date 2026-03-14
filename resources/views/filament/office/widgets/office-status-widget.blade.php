<x-filament-widgets::widget>
    <x-filament::section
        class="relative overflow-hidden"
    >
        @php
            /**
             * حالات:
             * - Pending (غير نشط) => warning
             * - Blocked (محظور) => danger
             * - Active => success
             */

            $isActive = (bool) ($isActive ?? false);
            $isBlocked = (bool) ($isBlocked ?? false);
            $statusKey = in_array(($statusColor ?? null), ['success', 'warning', 'danger'], true)
                ? $statusColor
                : 'success';

            if (!$isActive && $statusKey === 'success') {
                $statusKey = 'warning';
            }

            if ($isBlocked) {
                $statusKey = 'danger';
            }

            $styles = [
                'success' => [
                    'accent' => 'bg-emerald-500',
                    'bg'     => 'bg-emerald-50 dark:bg-emerald-900/15',
                    'border' => 'border-emerald-200 dark:border-emerald-800/60',
                    'iconBg' => 'bg-emerald-100 dark:bg-emerald-900/35',
                    'icon'   => 'text-emerald-600 dark:text-emerald-300',
                    'title'  => 'text-emerald-900 dark:text-emerald-100',
                    'text'   => 'text-emerald-700 dark:text-emerald-200/90',
                    'badge'  => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/35 dark:text-emerald-200',
                    'ring'   => 'ring-emerald-200/60 dark:ring-emerald-800/60',
                ],
                'warning' => [
                    'accent' => 'bg-amber-500',
                    'bg'     => 'bg-amber-50 dark:bg-amber-900/15',
                    'border' => 'border-amber-200 dark:border-amber-800/60',
                    'iconBg' => 'bg-amber-100 dark:bg-amber-900/35',
                    'icon'   => 'text-amber-700 dark:text-amber-300',
                    'title'  => 'text-amber-900 dark:text-amber-100',
                    'text'   => 'text-amber-800/90 dark:text-amber-200/90',
                    'badge'  => 'bg-amber-100 text-amber-800 dark:bg-amber-900/35 dark:text-amber-200',
                    'ring'   => 'ring-amber-200/60 dark:ring-amber-800/60',
                ],
                'danger' => [
                    'accent' => 'bg-rose-500',
                    'bg'     => 'bg-rose-50 dark:bg-rose-900/15',
                    'border' => 'border-rose-200 dark:border-rose-800/60',
                    'iconBg' => 'bg-rose-100 dark:bg-rose-900/35',
                    'icon'   => 'text-rose-600 dark:text-rose-300',
                    'title'  => 'text-rose-900 dark:text-rose-100',
                    'text'   => 'text-rose-700 dark:text-rose-200/90',
                    'badge'  => 'bg-rose-100 text-rose-700 dark:bg-rose-900/35 dark:text-rose-200',
                    'ring'   => 'ring-rose-200/60 dark:ring-rose-800/60',
                ],
            ];

            $s = $styles[$statusKey] ?? $styles['success'];

            $headline = match ($statusKey) {
                'success' => 'حسابك نشط',
                'warning' => 'حسابك قيد المراجعة',
                'danger'  => 'تم حظر حسابك',
                default   => 'حالة الحساب',
            };

            $subText = '';

            if ($statusKey === 'warning') {
                $subText = 'حسابك قيد المراجعة. سيتم إشعارك عند تفعيل الحساب.';
            } elseif ($statusKey === 'danger') {
                $subText = 'تم حظر حسابك. يرجى التواصل مع الإدارة لحل المشكلة.';
            } else {
                $subText = 'يمكنك الآن استخدام جميع الميزات المتاحة.';
            }

            // اختيار أيقونة مناسبة للحالة
            $icon = match ($statusKey) {
                'success' => 'heroicon-o-check-circle',
                'warning' => 'heroicon-o-clock',
                'danger'  => 'heroicon-o-x-circle',
                default   => 'heroicon-o-information-circle',
            };

            // شارة صغيرة مثل اللي في الصورة
            $badge = match ($statusKey) {
                'success' => 'نشط',
                'warning' => 'قيد المراجعة',
                'danger'  => 'محظور',
                default   => '—',
            };
        @endphp

        {{-- Header --}}
        <x-slot name="heading">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                        <x-filament::icon icon="heroicon-o-building-office-2" class="h-5 w-5 text-gray-700 dark:text-gray-200" />
                    </span>
                    <div class="leading-tight">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">حالة المكتب</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">آخر تحديث للحالة</div>
                    </div>
                </div>

                <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-semibold {{ $s['badge'] }} ring-1 {{ $s['ring'] }}">
                    <span class="h-2 w-2 rounded-full {{ $s['accent'] }}"></span>
                    {{ $badge }}
                </span>
            </div>
        </x-slot>

        {{-- Accent top line (زي الصورة) --}}
        <div class="absolute inset-x-0 top-0 h-1 {{ $s['accent'] }}"></div>

        {{-- Body --}}
        <div dir="rtl" class="pt-2">
            <div class="rounded-2xl border {{ $s['border'] }} {{ $s['bg'] }} shadow-sm">
                <div class="p-5 sm:p-6">
                    <div class="flex items-start gap-4">
                        {{-- Icon circle --}}
                        <div class="shrink-0">
                            <div class="h-12 w-12 rounded-2xl {{ $s['iconBg'] }} ring-1 {{ $s['ring'] }} flex items-center justify-center">
                                <x-filament::icon icon="{{ $icon }}" class="h-7 w-7 {{ $s['icon'] }}" />
                            </div>
                        </div>

                        {{-- Texts --}}
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <p class="text-base font-bold {{ $s['title'] }}">
                                    {{ $headline }}
                                </p>

                                {{-- لو عندك متغير $statusText وعايز تعرضه --}}
                                @if(!empty($statusText))
                                    <span class="text-xs px-2 py-1 rounded-full bg-white/60 dark:bg-white/10 text-gray-700 dark:text-gray-200 ring-1 ring-gray-200/60 dark:ring-white/10">
                                        {{ $statusText }}
                                    </span>
                                @endif
                            </div>

                            <p class="mt-2 text-sm leading-relaxed {{ $s['text'] }}">
                                {{ $subText }}
                            </p>

                            {{-- Actions --}}
                            <div class="mt-4 flex flex-wrap gap-2">
                                @if($statusKey === 'danger')
                                    <a
                                        href="#"
                                        class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-sm font-semibold bg-white dark:bg-gray-900 text-gray-900 dark:text-white ring-1 ring-gray-200 dark:ring-white/10 hover:shadow-sm transition"
                                    >
                                        تواصل مع الإدارة
                                    </a>
                                @elseif($statusKey === 'warning')
                                    <a
                                        href="#"
                                        class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-sm font-semibold bg-white dark:bg-gray-900 text-gray-900 dark:text-white ring-1 ring-gray-200 dark:ring-white/10 hover:shadow-sm transition"
                                    >
                                        متابعة حالة التفعيل
                                    </a>
                                @else
                                    <span class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-semibold bg-white/70 dark:bg-white/10 text-gray-800 dark:text-gray-200 ring-1 ring-gray-200/60 dark:ring-white/10">
                                        <x-filament::icon icon="heroicon-o-sparkles" class="h-4 w-4" />
                                        جاهز للاستخدام
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Small footer row (زي الداشبورد cards) --}}
                    <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="rounded-2xl bg-white/70 dark:bg-white/10 ring-1 ring-gray-200/60 dark:ring-white/10 p-4">
                            <div class="text-xs text-gray-500 dark:text-gray-400">الحالة الحالية</div>
                            <div class="mt-1 text-sm font-bold text-gray-900 dark:text-white">{{ $badge }}</div>
                        </div>

                        <div class="rounded-2xl bg-white/70 dark:bg-white/10 ring-1 ring-gray-200/60 dark:ring-white/10 p-4">
                            <div class="text-xs text-gray-500 dark:text-gray-400">نوع الحساب</div>
                            <div class="mt-1 text-sm font-bold text-gray-900 dark:text-white">مكتب</div>
                        </div>

                        <div class="rounded-2xl bg-white/70 dark:bg-white/10 ring-1 ring-gray-200/60 dark:ring-white/10 p-4">
                            <div class="text-xs text-gray-500 dark:text-gray-400">ملاحظات</div>
                            <div class="mt-1 text-sm font-bold text-gray-900 dark:text-white">
                                {{ $statusKey === 'success' ? 'لا توجد' : 'تحتاج إجراء' }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
