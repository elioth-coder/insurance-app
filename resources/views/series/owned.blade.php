@php
    $breadcrumbs = [
        [
            'url' => '/series',
            'title' => 'Series',
        ],
        [
            'url' => '/series/owned',
            'title' => 'Owned',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="w-full pb-6 pt-2">
        <div class="flex">
            <div class="relative overflow-x-auto shadow-md w-full">
                <table id="owned_series-table"
                    class="bg-white w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4">Assigned Date</th>
                            <th class="px-6 py-4">Series No.</th>
                            <th class="px-6 py-4">Assigned To</th>
                            <th class="px-6 py-4">Used Date</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($series_numbers as $series_number)
                            @php
                                if($series_number->subagent_id) {
                                    $subagent = $agents[$series_number->subagent_id];
                                }
                            @endphp
                            <tr class="group cursor-pointer">
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $series_number->created_at }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $series_number->series_number }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                    @if($subagent)
                                        [{{ $subagent->branch }}] -
                                        {{ $subagent->first_name }}
                                        {{ $subagent->last_name }}
                                    @else
                                        {{ '--' }}
                                    @endif
                                </td>
                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                    {{ $series_number->used_date ? $series_number->used_date : '--' }}</td>
                                <td class="group-hover:bg-violet-200 px-8 py-6 capitalize">
                                    @if ($series_number->status == 'available')
                                        <span class="bg-green-500 rounded-lg text-white inline-block px-1 text-xs">Available</span>
                                    @elseif ($series_number->status == 'assigned')
                                        <span class="bg-yellow-500 rounded-lg text-white inline-block px-1 text-xs">Assigned</span>
                                    @else
                                        <span class="bg-red-500 rounded-lg text-white inline-block px-1 text-xs">Used</span>
                                    @endif
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
                    if (document.getElementById("owned_series-table") && typeof DataTable !==
                        'undefined') {
                        const dataTable = new DataTable("#owned_series-table", {
                            fixedHeight: true,
                            searchable: true,
                            perPageSelect: [10, 20, 50, 100],
                        });
                    }
                }, 1000);
            })();
        </script>
    </x-slot>
</x-layout>
