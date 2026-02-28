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
        class="relative flex items-center justify-center w-9 h-9 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white transition-colors"
        type="button"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
        @if($unreadCount > 0)
            <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] font-semibold text-white leading-none">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    <div
        x-show="open"
        @click.away="open = false"
        x-transition
        class="absolute right-0 mt-2 w-80 rounded-lg bg-white dark:bg-gray-800 shadow-xl ring-1 ring-gray-950/5 dark:ring-white/10 z-50"
        style="display: none;"
    >
        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">الإشعارات</h3>
        </div>
        <div class="max-h-96 overflow-y-auto">
            @if($notifications->count() > 0)
                @foreach($notifications as $recipient)
                    <a
                        href="{{ \App\Filament\Pages\NotificationsPage::getUrl() }}"
                        class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700 transition-colors {{ !$recipient->read_at ? 'bg-primary-50/50 dark:bg-primary-900/10' : '' }}"
                    >
                        <div class="flex items-start gap-3">
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-sm text-gray-900 dark:text-white">{{ $recipient->notification->title ?? 'إشعار' }}</p>
                                @if($recipient->notification->body)
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">
                                        {{ $recipient->notification->body }}
                                    </p>
                                @endif
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1.5">
                                    {{ $recipient->created_at->diffForHumans() }}
                                </p>
                            </div>
                            @if(!$recipient->read_at)
                                <span class="mt-1.5 h-2 w-2 rounded-full bg-primary-500 flex-shrink-0"></span>
                            @endif
                        </div>
                    </a>
                @endforeach
            @else
                <div class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                    لا توجد إشعارات
                </div>
            @endif
        </div>
        <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-700">
            <a
                href="{{ \App\Filament\Pages\NotificationsPage::getUrl() }}"
                class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors"
            >
                عرض جميع الإشعارات
            </a>
        </div>
    </div>
</div>
