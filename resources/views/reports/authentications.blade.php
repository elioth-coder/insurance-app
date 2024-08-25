@php
    $breadcrumbs = [
        [
            'url' => '/reports',
            'title' => 'Reports',
        ],
        [
            'url' => '#',
            'title' => 'Authentications',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="py-3 min-h-screen">
        <div class="flex flex-col">
            <form class="my-2 w-full flex justify-between" action="/reports/authentications" method="GET">
                <div class="inline-flex items-center">
                    <span class="me-2">From:</span>
                    <input type="date" name="from_date" value="{{ date('Y-m-d') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div class="inline-flex items-center">
                    <span class="me-2">To:</span>
                    <input type="date" name="to_date" value="{{ date('Y-m-d') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
            </form>
            <div class="relative overflow-x-auto w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
                <x-reports.authentications-table :$authentications />
            </div>
            <section class="inline-flex w-full py-5">
                <a href="/reports/authentications/print" target="_blank"
                    class="text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-6 py-3 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Print
                    <svg class="w-6 h-6 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </section>
        </div>
    </div>
</x-layout>
