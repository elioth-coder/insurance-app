@php
    $breadcrumbs = [
        [
            'url' => '/settings',
            'title' => 'Application Settings',
        ],
        [
            'url' => '/settings/vehicle_types',
            'title' => 'Vehicle Types',
        ],
        [
            'url' => '/settings/vehicle_types/create',
            'title' => 'Add New',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="flex space-x-3 min-h-screen">
        <div class="w-3/5 pb-6 pt-2">
            <div class="max-w-xl">
                @if (session('message'))
                    <x-alerts.success id="alert-vehicle_types">
                        {{ session('message') }}
                    </x-alerts.success>
                @endif
            </div>
            <x-card class="max-w-xl">
                <x-card-header>New Vehicle Type</x-card-header>
                <x-forms.form method="POST" action="/settings/vehicle_types">
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full"
                            name="code" type="text"
                            label="Code"
                            maxlength="5"
                            placeholder="--"
                            required
                        />
                        <div class="w-full"></div>
                    </div>
                    <x-forms.input-field class="w-full"
                        name="type"
                        type="text"
                        label="Vehicle Type"
                        placeholder="--"
                        required
                    />
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full"
                            name="one_year"
                            type="number"
                            label="One (1) year coverage"
                            placeholder="--"
                            step="0.1"
                            required
                        />
                        <x-forms.input-field class="w-full"
                            name="three_years"
                            type="number"
                            label="Three (3) years coverage"
                            placeholder="--"
                            step="0.1"
                            required
                        />
                    </div>
                    <hr class="my-1">
                    <div class="flex space-x-2 justify-end">
                        <span class="inline-block w-32">
                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                        </span>
                        <a href="/settings/vehicle_types"
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
                        This will be the pricing per vehicle on CTPL insurance application.
                    </li>
                </ul>
            </section>
        </div>
    </div>
</x-layout>
