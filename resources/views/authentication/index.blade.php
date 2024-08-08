@php
    $breadcrumbs = [
        [
            'url' => '/authentication',
            'title' => 'Authentication',
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
                <table id="assured_vehicles-table"
                    class="bg-white w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">COC No.</th>
                            <th class="px-6 py-4">Plate No.</th>
                            <th class="px-6 py-4">MV Type</th>
                            <th class="px-6 py-4">Assured Name</th>
                            <th class="px-6 py-4">Address</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($authentications as $authentication)
                            <tr class="group cursor-pointer">
                                <td class="group-hover:bg-violet-200 px-8 py-6 capitalize">{{ $authentication->type }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $authentication->coc_number }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $authentication->plate_number ?? '--' }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $authentication->lto_mv_type }} | {{ $authentication->vehicle_type }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $authentication->assured_name }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $authentication->assured_address  }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                    <a href="/authentication/{{ $authentication->id }}/print" target="_blank" title="Print" type="button" class="text-violet-600 border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded text-sm p-2 text-center inline-flex items-center dark:border-violet-600 dark:text-violet-600 dark:hover:text-white dark:focus:ring-violet-800 dark:hover:bg-violet-600">
                                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No data found.</td>
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
                    if (document.getElementById("assured_vehicles-table") && typeof DataTable !==
                        'undefined') {
                        const dataTable = new DataTable("#assured_vehicles-table", {
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
