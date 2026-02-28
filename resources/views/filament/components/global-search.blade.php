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
            class="w-64 rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:border-primary-500 focus:ring-primary-500 pr-10"
        />
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <div
        x-show="open && results.length > 0"
        x-transition
        class="absolute right-0 mt-2 w-96 rounded-lg bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 z-50 max-h-96 overflow-y-auto"
        style="display: none;"
    >
        <template x-for="result in results" :key="result.id">
            <a
                :href="result.url"
                class="block p-4 hover:bg-gray-50 dark:hover:bg-gray-700 border-b border-gray-200 dark:border-gray-700"
            >
                <div class="flex items-start">
                    <div class="flex-1">
                        <p class="font-medium text-sm" x-text="result.title"></p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1" x-text="result.type"></p>
                    </div>
                </div>
            </a>
        </template>
    </div>
</div>
