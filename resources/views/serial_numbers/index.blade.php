@php
    $breadcrumbs = [
        [
            'url' => '/serial_numbers',
            'title' => 'Serial Numbers',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="py-3 min-h-screen">
        <div class="mx-auto max-w-full">
            @if (session('message'))
                <x-alerts.success id="alert-serial">
                    {{ session('message') }}
                </x-alerts.success>
            @endif
        </div>

        <div class="flex">
            <div class="relative overflow-x-auto shadow-md w-full">
                <table id="serial_numbers-table"
                    class="bg-white w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-4">Date Modified</th>
                            <th class="px-6 py-4">Serial Number</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Updated by</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($serial_numbers as $serial_number)
                            <tr class="group cursor-pointer">
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ date('m-d-Y', strtotime($serial_number->updated_at)) }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $serial_number->serial }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                    @php
                                        $colors = [
                                            'Available' => 'blue',
                                            'For Verification' => 'yellow',
                                            'Verified' => 'green',
                                            'Voided' => 'red',
                                        ]
                                    @endphp
                                    {{-- bg-blue-700 bg-yellow-700 bg-green-700 bg-red-700 --}}
                                    <span class="bg-{{ $colors[$serial_number->status] }}-700 rounded-lg px-1 text-xs text-white">
                                        {{ $serial_number->status }}
                                    </span>
                                </td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $serial_number->agent_id ?? '--' }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                    <a href="/serial_numbers/{{ $serial_number->id }}" type="button" class="text-violet-600 mx-auto border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded text-sm p-2 text-center inline-flex items-center dark:border-violet-600 dark:text-violet-600 dark:hover:text-white dark:focus:ring-violet-800 dark:hover:bg-violet-600">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No data found.</td>
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
                    if (document.getElementById("serial_numbers-table") && typeof DataTable !==
                        'undefined') {
                        const dataTable = new DataTable("#serial_numbers-table", {
                            fixedHeight: true,
                            searchable: true,
                            perPage: 50,
                        });
                    }
                }, 1000);
            })();
        </script>
    </x-slot:script>
</x-layout>
