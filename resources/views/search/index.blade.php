@php
    $breadcrumbs = [
        [
            'url' => '/search',
            'title' => 'Search',
        ],
        [
            'url' => '#',
            'title' => request()->input('query'),
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="py-3 min-h-screen">
        <div class="flex flex-col">
            <h2 class="pt-2 text-xl mx-1 mb-2">Search results for - "{{ request()->get('query') }}"</h2>
            <div class="relative overflow-x-auto w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
                @if (!empty($authentication))
                    <x-authenticated-table :$authentication :$settings :$vehicle_type />
                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                    <section class="inline-flex justify-end w-full mt-3">
                        <a href="/authentication/{{ $authentication->id }}/print"
                            target="_blank"
                            class="text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Print
                            <svg class="w-4 h-4 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="/dashboard"
                            class="text-violet-700 hover:text-white border border-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center mb-2 dark:border-violet-400 dark:text-violet-400 dark:hover:text-white dark:hover:bg-violet-500 dark:focus:ring-violet-900">
                            Back
                            <svg class="w-4 h-4 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                        </a>
                    </section>
                @else
                    <img src="{{ asset('images/no-result-found.png') }}" class="block mx-auto w-[400px]" />
                    <h3 class="text-center text-2xl text-gray-500/75 font-bold">No results found</h3>
                @endif
            </div>
        </div>
    </div>
</x-layout>
