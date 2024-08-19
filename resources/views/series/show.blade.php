@php
    $series_start = ($series->prefix ?? '') . $series->start . ($series->suffix ?? '');
    $series_end   = ($series->prefix ?? '') . $series->end   . ($series->suffix ?? '');

    $breadcrumbs = [
        [
            'url' => '/series',
            'title' => 'Series',
        ],
        [
            'url' => '/series/' . $series->id,
            'title' => $series_start . ' - ' . $series_end,
        ]
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="w-full pb-6 pt-2">
        <div class="flex">
            <div class="relative overflow-x-auto shadow-md w-full">
                <table id="assigned_series-table"
                    class="bg-white w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Assigned Date</th>
                            <th class="px-6 py-4">Agent Name</th>
                            <th class="px-6 py-4">Series No.</th>
                            <th class="px-6 py-4">Used Date</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($series->series_numbers as $series_number)
                            <tr class="group cursor-pointer">
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $series_number->created_at }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $series_number->agent->first_name }} {{ $series_number->agent->last_name }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $series_number->series_number }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ ($series_number->used_date) ? $series_number->used_date : '--' }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6 capitalize">{{ $series_number->status }}</td>
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
                    if (document.getElementById("assigned_series-table") && typeof DataTable !==
                        'undefined') {
                        const dataTable = new DataTable("#assigned_series-table", {
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
