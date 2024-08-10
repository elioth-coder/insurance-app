@php
    $breadcrumbs = [
        [
            'url' => '/subagents',
            'title' => 'Subagents',
        ],
    ];

    $accidents = [
        [
            'report_number'  => 10001,
            'plate_number'   => 'ZSS1344',
            'mv_file_number' => '323220209111',
            'nature'         => 'Rear-end Collision',
            'summary'        => 'Vehicle rear-ended another at a traffic light.',
            'hpg_officer'    => 'Dindo Avanzado',
            'accident_date'  => '15-08-2024',
        ],
        [
            'report_number'  => 10002,
            'plate_number'   => 'ZSS1344',
            'mv_file_number' => '11412121209111',
            'nature'         => 'Side Swipe',
            'summary'        => 'Vehicle side-swiped another during lane change.',
            'hpg_officer'    => 'Martin Bulacan',
            'accident_date'  => '15-07-2024',
        ],
        [
            'report_number'  => 10003,
            'plate_number'   => 'XLHS5255',
            'mv_file_number' => '209092121209111',
            'nature'         => 'Rollover',
            'summary'        => 'Vehicle lost control and rolled over on the highway.',
            'hpg_officer'    => 'Dindo Avanzado',
            'accident_date'  => '12-08-2024',
        ],
        [
            'report_number'  => 10004,
            'plate_number'   => 'TKAY344',
            'mv_file_number' => '19929221209111',
            'nature'         => 'Hit and Run',
            'summary'        => 'Vehicle struck a pedestrian and fled the scene.',
            'hpg_officer'    => 'Banjo Reguyal',
            'accident_date'  => '02-07-2024',
        ],
        [
            'report_number'  => 10005,
            'plate_number'   => 'LLAP1344',
            'mv_file_number' => '929349829111',
            'nature'         => 'Rear-end Collision',
            'summary'        => 'Vehicles collided head-on at an intersection.',
            'hpg_officer'    => 'Junmar Mercado',
            'accident_date'  => '16-12-2024',
        ],
    ];

@endphp

<x-layout :$breadcrumbs>
    <div class="py-3 min-h-screen">
        <div class="mx-auto max-w-full">
            @if (session('message'))
                <x-alerts.success id="alert-subagent">
                    {{ session('message') }}
                </x-alerts.success>
            @endif
        </div>

        <div class="flex">
            <div class="relative overflow-x-auto shadow-md w-full">
                <h2 class="text-2xl text-center">HPG - Reported Accidents</h2>
                <table id="accidents-table"
                    class="bg-white w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Report no.</th>
                            <th class="px-6 py-4">HPG Officer</th>
                            <th class="px-6 py-4">Nature</th>
                            <th class="px-6 py-4">MV File/Plate no.</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($accidents as $accident)
                            <tr class="group cursor-pointer">
                                <td class="group-hover:bg-violet-200 px-6 py-4">{{ $accident['report_number'] }}</td>
                                <td class="group-hover:bg-violet-200 px-6 py-4">{{ $accident['hpg_officer'] }}</td>
                                <td class="group-hover:bg-violet-200 px-6 py-4">{{ $accident['nature'] }}</td>
                                <td class="group-hover:bg-violet-200 px-6 py-4">{{ $accident['mv_file_number'] }}</td>
                                <td class="group-hover:bg-violet-200 px-6 py-4">{{ $accident['accident_date'] }}</td>
                                <td class="group-hover:bg-violet-200 px-6 py-4">
                                    <a href="/authentication/claim/{{ $accident['report_number'] }}" title="Claim Insurance" type="button" class="text-violet-600 border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded text-sm p-2 text-center inline-flex items-center dark:border-violet-600 dark:text-violet-600 dark:hover:text-white dark:focus:ring-violet-800 dark:hover:bg-violet-600">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21v-9m3-4H7.5a2.5 2.5 0 1 1 0-5c1.5 0 2.875 1.25 3.875 2.5M14 21v-9m-9 0h14v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-8ZM4 8h16a1 1 0 0 1 1 1v3H3V9a1 1 0 0 1 1-1Zm12.155-5c-3 0-5.5 5-5.5 5h5.5a2.5 2.5 0 0 0 0-5Z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot:script>
        <script>
            (function() {
                setTimeout(() => {
                    if (document.getElementById("accidents-table") && typeof DataTable !== 'undefined') {
                        const dataTable = new DataTable("#accidents-table", {
                            fixedHeight: true,
                            searchable: true,
                            perPage: 5,
                        });
                    }
                }, 1000);
            })();
        </script>
    </x-slot>
</x-layout>
