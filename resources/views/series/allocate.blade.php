@php
    $breadcrumbs = [
        [
            'url' => '/series',
            'title' => 'Series',
        ],
        [
            'url' => '/series/create',
            'title' => 'Assign',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="flex space-x-3">
        <div class="w-3/5 pb-6 pt-2">
            <div class="max-w-xl">
                @if (session('message'))
                    <x-alerts.success id="alert-subagent">
                        {{ session('message') }}
                    </x-alerts.success>
                @endif
            </div>
            <x-card class="max-w-xl">
                <x-card-header>Assign Series</x-card-header>
                <x-forms.form method="POST" action="/series">
                    <x-forms.select-field class="w-full" name="subagent_id" label="Subagent"
                        placeholder="-- Select subagent --" required>
                        @foreach ($agents as $agent)
                            <option value="{{ $agent->id }}" {{ old('subagent_id') == $agent->id ? 'selected' : '' }}>
                                {{ $agent->last_name }},
                                {{ $agent->first_name }} -
                                [{{ $agent->branch ?? '--' }}]
                            </option>
                        @endforeach
                    </x-forms.select-field>
                    <section class="px-2">
                        <label for="check_all">
                            <input type="checkbox" id="check_all">
                            &nbsp;Check All
                        </label>
                        @error('series_number')
                            <x-forms.error>{{ $message }}</x-forms.error>
                        @enderror
                    </section>
                    <table id="series_numbers-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Number</th>
                                <th>Series No.</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($series_numbers as $series_number)
                                <tr>
                                    <td>
                                        <input class="series_number_checkbox" value="{{ $series_number->id }}" name="series_number[]"
                                            type="checkbox" />
                                    </td>
                                    <td>{{ $series_number->number }}</td>
                                    <td>{{ $series_number->series_number }}</td>
                                    <td>
                                        @if ($series_number->status=='available')
                                            <span class="bg-green-500 rounded-lg text-white inline-block px-1 text-xs">Available</span>
                                        @elseif ($series_number->status=='assigned')
                                            <span class="bg-yellow-500 rounded-lg text-white inline-block px-1 text-xs">Assigned</span>
                                        @else
                                            <span class="bg-red-500 rounded-lg text-white inline-block px-1 text-xs">Used</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr class="my-1">
                    <div class="flex space-x-2 justify-end">
                        <span class="inline-block w-32">
                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                        </span>
                        <a href="/subagents"
                            class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                            Back
                        </a>
                    </div>
                </x-forms.form>
            </x-card>
        </div>
        <div class="w-2/5 pb-6 pt-2">
            <section class="bg-violet-500 text-white p-8 rounded-lg">
                <h2 class="mb-2 text-lg font-semibold dark:text-white">IMPORTANT NOTES:</h2>
                <ul class="max-w-md space-y-1 list-disc list-inside dark:text-gray-400">
                    <li>
                        The maximum limit is 10000 per COC series assignment
                    </li>
                    <li>
                        Check COC series before assigning
                    </li>
                </ul>
            </section>
        </div>
    </div>

    <x-slot:script>
        <script>
            function checkAll(bool) {
                console.log(bool);
                if(bool) {
                    let nodes = document.querySelectorAll(`.series_number_checkbox:not(:checked)`)
                    console.log(nodes);
                    if(nodes.length) {
                        nodes.forEach(element => element.click());
                    }
                } else {
                    let nodes = document.querySelectorAll(`.series_number_checkbox:checked`)
                    console.log(nodes);
                    if(nodes.length) {
                        nodes.forEach(element => element.click());
                    }
                }
            }
            (function() {
                setTimeout(() => {
                    if (document.getElementById("series_numbers-table") && typeof DataTable !==
                        'undefined') {
                        const dataTable = new DataTable("#series_numbers-table", {
                            fixedHeight: true,
                            searchable: true,
                            perPageSelect: [10, 20, 50, 100],
                        });
                    }

                    document.getElementById('check_all').onclick = (e) => {
                        checkAll(e.target.checked);
                    }
                }, 1000);
            })();
        </script>
    </x-slot>

</x-layout>
