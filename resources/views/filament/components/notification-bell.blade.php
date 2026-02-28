@php
    $user = auth()->user();
    $unreadCount = 0;
    $notifications = collect();
    
    if ($user) {
        $unreadCount = \App\Models\NotificationRecipient::on('system')
            ->where('channel', 'inapp')
            ->where('resolved_user_id', $user->id)
            ->where('status', 'sent')
            ->whereNull('read_at')
            ->count();
            
        $notifications = \App\Models\NotificationRecipient::on('system')
            ->with('notification')
            ->where('channel', 'inapp')
            ->where('resolved_user_id', $user->id)
            ->orderByDesc('id')
            ->limit(5)
            ->get();
    }
@endphp

<div class="relative" x-data="{ open: false }">
    <button
        @click="open = !open"
        class="relative p-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors"
        type="button"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-gray-900"></span>
            <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs font-bold text-white">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    <div
        x-show="open"
        @click.away="open = false"
        x-transition
        class="absolute right-0 mt-2 w-80 rounded-lg bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 z-50"
        style="display: none;"
    >
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold">الإشعارات</h3>
        </div>
        <div class="max-h-96 overflow-y-auto">
            @if($notifications->count() > 0)
                @foreach($notifications as $recipient)
                    <a
                        href="{{ \App\Filament\Pages\NotificationsPage::getUrl() }}"
                        class="block p-4 hover:bg-gray-50 dark:hover:bg-gray-700 border-b border-gray-200 dark:border-gray-700 {{ !$recipient->read_at ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}"
                    >
                        <div class="flex items-start">
                            <div class="flex-1">
                                <p class="font-medium text-sm">{{ $recipient->notification->title ?? 'إشعار' }}</p>
                                @if($recipient->notification->body)
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">
                                        {{ $recipient->notification->body }}
                                    </p>
                                @endif
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                    {{ $recipient->created_at->diffForHumans() }}
                                </p>
                            </div>
                            @if(!$recipient->read_at)
                                <span class="ml-2 h-2 w-2 rounded-full bg-primary-500"></span>
                            @endif
                        </div>
                    </a>
                @endforeach
            @else
                <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                    لا توجد إشعارات
                </div>
            @endif
        </div>
        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            <a
                href="{{ \App\Filament\Pages\NotificationsPage::getUrl() }}"
                class="text-sm text-primary-600 dark:text-primary-400 hover:underline"
            >
                عرض جميع الإشعارات
            </a>
        </div>
    </div>
</div>
