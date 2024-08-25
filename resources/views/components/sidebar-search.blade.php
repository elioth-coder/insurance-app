@php
    $path = request()->path();
    $segments = explode('/', $path);
    $segment_0 = $segments[0] ?? '';
@endphp

<div id="search" role="tabpanel" aria-labelled-by="search-tab"
    class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <h2 class="text-2xl font-black px-5">Search Results</h2>
    <hr>
    <form  action="/search" method="GET">
        <input type="search" name="query" value="{{ request()->get('query') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Enter a text to search." required />
        <section class="inline-flex justify-between w-full mt-3">
            <button type="button"
                class="text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Search
                <svg class="w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
            </button>
            <a href="{{ ($segment_0 == 'search') ? '/dashboard' : url()->previous() }}"
                class="text-violet-700 hover:text-white border border-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center mb-2 dark:border-violet-400 dark:text-violet-400 dark:hover:text-white dark:hover:bg-violet-500 dark:focus:ring-violet-900">
                Close
                <svg class="w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
            </a>
        </section>
    </form>
</div>
