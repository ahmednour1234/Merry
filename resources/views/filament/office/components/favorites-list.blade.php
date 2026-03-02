<div class="space-y-4">
    @foreach($favorites as $favorite)
        @php
            $user = $favorite->endUser;
        @endphp
        @if($user)
            <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4 bg-white dark:bg-gray-800">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            @if($user->avatar_url)
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                                    <span class="text-primary-600 dark:text-primary-300 font-semibold text-sm">
                                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ $user->name ?? 'غير محدد' }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $user->id }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                            @if($user->phone)
                                <div class="flex items-center gap-2 text-sm">
                                    <x-filament::icon icon="heroicon-o-phone" class="h-4 w-4 text-gray-400" />
                                    <a href="tel:{{ $user->phone }}" class="text-primary-600 dark:text-primary-400 hover:underline">
                                        {{ $user->phone }}
                                    </a>
                                </div>
                            @endif
                            
                            @if($user->national_id)
                                <div class="flex items-center gap-2 text-sm">
                                    <x-filament::icon icon="heroicon-o-identification" class="h-4 w-4 text-gray-400" />
                                    <span class="text-gray-700 dark:text-gray-300">{{ $user->national_id }}</span>
                                </div>
                            @endif
                            
                            @if($user->city_id)
                                <div class="flex items-center gap-2 text-sm">
                                    <x-filament::icon icon="heroicon-o-map-pin" class="h-4 w-4 text-gray-400" />
                                    <span class="text-gray-700 dark:text-gray-300">المدينة: {{ $user->city_id }}</span>
                                </div>
                            @endif
                            
                            <div class="flex items-center gap-2 text-sm">
                                <x-filament::icon icon="heroicon-o-calendar" class="h-4 w-4 text-gray-400" />
                                <span class="text-gray-700 dark:text-gray-300">
                                    أضاف في: {{ $favorite->created_at->format('Y-m-d H:i') }}
                                </span>
                            </div>
                        </div>
                        
                        @if($user->bio)
                            <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $user->bio }}</p>
                        @endif
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        @if($user->phone)
                            <a href="tel:{{ $user->phone }}" 
                               class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 transition">
                                <x-filament::icon icon="heroicon-o-phone" class="h-4 w-4" />
                                اتصال
                            </a>
                        @endif
                        
                        @if($user->phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" 
                               target="_blank"
                               class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                                <x-filament::icon icon="heroicon-o-chat-bubble-left-right" class="h-4 w-4" />
                                واتساب
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
