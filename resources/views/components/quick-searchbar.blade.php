<form class="max-w-lg mx-auto" action="/search" method="GET">
    <div class="flex">
        <input type="search"
            name="query"
            value="{{ request()->input('query') ?? '' }}"
            class="block p-2.5 w-full z-20 text-gray-900 bg-gray-50 rounded-s-lg border-e-gray-50 border-e-2 border border-gray-300 focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-violet-500"
            placeholder="Enter MV details" required />
        <div class="relative w-auto flex">
            <button type="submit"
                class="p-2.5 px-4 text-sm font-medium h-full text-white bg-violet-700 rounded-e-lg border border-violet-700 hover:bg-violet-800 focus:outline-none focus:ring-violet-300 dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus:ring-violet-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>
