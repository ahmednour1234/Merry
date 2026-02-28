<div class="relative" x-data="{ open: false, query: '', results: [], loading: false }" x-on:click.away="open = false">
    <div class="relative">
        <input
            type="text"
            x-model="query"
            @input.debounce.300ms="
                if (query.length > 2) {
                    loading = true;
                    fetch('{{ url('/admin/api/search') }}?q=' + encodeURIComponent(query))
                        .then(response => response.json())
                        .then(data => {
                            results = data;
                            open = true;
                            loading = false;
                        })
                        .catch(() => {
                            loading = false;
                        });
                } else {
                    results = [];
                    open = false;
                }
            "
            placeholder="بحث..."
            class="fi-input block w-full rounded-lg border-none bg-white dark:bg-white/5 px-3 py-2 pr-10 text-base text-gray-950 outline-none transition duration-75 placeholder:text-gray-400 focus:ring-2 focus:ring-primary-500 dark:text-white dark:placeholder:text-gray-500 sm:text-sm"
        />
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <div
        x-show="open && results.length > 0"
        x-transition
        class="absolute right-0 mt-2 w-96 rounded-lg bg-white dark:bg-gray-800 shadow-xl ring-1 ring-gray-950/5 dark:ring-white/10 z-50 max-h-96 overflow-y-auto"
        style="display: none;"
    >
        <template x-for="result in results" :key="result.id">
            <a
                :href="result.url"
                class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700 transition-colors"
            >
                <div class="flex items-start gap-3">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-sm text-gray-900 dark:text-white truncate" x-text="result.title"></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5" x-text="result.type"></p>
                    </div>
                </div>
            </a>
        </template>
    </div>
</div>
