@props(['logs' => collect(), 'title' => 'سجلات الاشتراك'])

@php
    $actionLabels = [
        'created' => 'إنشاء',
        'updated' => 'تحديث',
        'cancelled' => 'إلغاء اشتراك',
        'deactivated' => 'إيقاف تفعيل',
        'auto_renew_toggled' => 'تجديد تلقائي',
        'renewed' => 'تجديد',
        'cv_created' => 'رفع سيرة ذاتية',
    ];
    $actionBadges = [
        'created' => 'success',
        'updated' => 'info',
        'cancelled' => 'danger',
        'deactivated' => 'warning',
        'auto_renew_toggled' => 'primary',
        'renewed' => 'success',
        'cv_created' => 'info',
    ];
@endphp

<div class="subscription-logs overflow-x-auto" dir="rtl">
    <h3 class="text-lg font-semibold mb-3">{{ $title }}</h3>
    @if($logs->isEmpty())
        <p class="text-gray-500">لا توجد سجلات.</p>
    @else
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">#</th>
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">الإجراء</th>
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">المستخدم</th>
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">التاريخ</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($logs as $log)
                    <tr>
                        <td class="px-4 py-2 text-sm">{{ $log->id }}</td>
                        <td class="px-4 py-2">
                            @php $label = $actionLabels[$log->action] ?? $log->action; $badge = $actionBadges[$log->action] ?? 'gray'; @endphp
                            <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full
                            @if($badge === 'success') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                            @elseif($badge === 'danger') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                            @elseif($badge === 'warning') bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400
                            @elseif($badge === 'info') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                            @elseif($badge === 'primary') bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400
                            @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif">{{ $label }}</span>
                        </td>
                        <td class="px-4 py-2 text-sm">{{ $log->user?->name ?? '—' }}</td>
                        <td class="px-4 py-2 text-sm">{{ $log->created_at?->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
