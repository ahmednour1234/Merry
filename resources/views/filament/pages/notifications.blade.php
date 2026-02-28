<x-filament-panels::page>
    <div class="space-y-4">
        @php
            $user = auth()->user();
            $notifications = \App\Models\NotificationRecipient::on('system')
                ->with('notification')
                ->where('channel', 'inapp')
                ->where('resolved_user_id', $user->id)
                ->orderByDesc('id')
                ->paginate(20);
        @endphp

        @if($notifications->count() > 0)
            <div class="space-y-2">
                @foreach($notifications as $recipient)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 {{ $recipient->read_at ? 'opacity-60' : '' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg">{{ $recipient->notification->title ?? 'إشعار' }}</h3>
                                @if($recipient->notification->body)
                                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $recipient->notification->body }}</p>
                                @endif
                                <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">
                                    {{ $recipient->created_at->diffForHumans() }}
                                </p>
                            </div>
                            @if(!$recipient->read_at)
                                <form method="POST" action="{{ route('filament.admin.pages.notifications.mark-read', $recipient->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-primary-600 hover:text-primary-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $notifications->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 dark:text-gray-400">لا توجد إشعارات</p>
            </div>
        @endif
    </div>
</x-filament-panels::page>
