@php
    $breadcrumbs = [
        [
            'url' => '/serial_numbers',
            'title' => 'Serial_numbers',
        ],
        [
            'url' => '/serial_numbers/create',
            'title' => 'Generate',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="flex space-x-3 min-h-screen">
        <div class="w-3/5 pb-6 pt-2">
            <div class="max-w-xl">
                @if (session('message'))
                    <x-alerts.success id="alert-subagent">
                        {{ session('message') }}
                    </x-alerts.success>
                @endif
            </div>
            <x-card class="max-w-xl">
                <x-card-header>Generate Serials</x-card-header>
                <x-forms.form method="POST" action="/serial_numbers">
                    <x-forms.input-field class="w-full" name="quantity" type="number" label="Quantity of serials to generate"
                        maxlength="5"
                        placeholder="--" required />
                    <hr class="my-1">
                    <div class="flex space-x-2 justify-end">
                        <span class="inline-block w-32">
                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                        </span>
                        <a href="/serial_numbers"
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
                        The maximum limit is 10,000 serial numbers
                    </li>
                </ul>
            </section>
        </div>
    </div>
</x-layout>
