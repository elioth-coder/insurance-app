@php
    $breadcrumbs = [
        [
            'url' => '/coc_series',
            'title' => 'COC Series',
        ],
        [
            'url' => '/coc_series/create',
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
                <x-forms.form method="POST" action="/coc_series">
                    <x-forms.select-field class="w-full" name="agent_id" label="Subagent"
                        placeholder="-- Select subagent --" required>
                        @foreach ($agents as $agent)
                            <option value="{{ $agent->id }}"
                                {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                                {{ $agent->last_name }},
                                {{ $agent->first_name }} -
                                [{{ $agent->branch ?? '--' }}]
                            </option>
                        @endforeach
                    </x-forms.select-field>
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full" name="prefix" type="text" label="Prefix (optional)"
                            placeholder="Enter prefix" />
                        <x-forms.input-field class="w-full" name="suffix" type="text" label="Suffix (optional)"
                            placeholder="Enter suffix" />
                    </div>
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full" name="start" type="text" label="Series From"
                            placeholder="Series From" required />
                        <x-forms.input-field class="w-full" name="end" type="text" label="Series To"
                            placeholder="Series To" required />
                    </div>
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
</x-layout>
