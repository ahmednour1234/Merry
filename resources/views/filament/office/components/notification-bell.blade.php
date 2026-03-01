@php
    $component = new \App\Filament\Office\Components\NotificationBell();
    $view = $component->render();
    $unreadCount = $view->getData()['unreadCount'] ?? 0;
@endphp

<a
    href="{{ \App\Filament\Office\Pages\NotificationsPage::getUrl() }}"
    class="relative flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800"
>
    <x-filament::icon
        icon="heroicon-o-bell"
        class="h-6 w-6"
    />

    @if($unreadCount > 0)
        <span
            class="absolute top-1 right-1 flex h-5 w-5 items-center justify-center rounded-full bg-danger-600 text-xs font-medium text-white"
        >
            {{ $unreadCount > 99 ? '99+' : $unreadCount }}
        </span>
    @endif
</a>
