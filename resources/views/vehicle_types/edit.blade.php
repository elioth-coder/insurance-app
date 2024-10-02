@php
    $breadcrumbs = [
        [
            'url' => '/vehicle_types',
            'title' => 'Vehicle Types',
        ],
        [
            'url' => "/vehicle_types/$vehicle_type->id",
            'title' => $vehicle_type->type,
        ],
        [
            'url' => "/vehicle_types/$vehicle_type->id/edit",
            'title' => 'Edit',
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
                <x-card-header>Edit Vehicle Type</x-card-header>
                <x-forms.form method="POST" action="/settings/vehicle_types/{{ $vehicle_type->id }}" verb="PATCH">
                    <div class="flex space-x-2">
                        @php
                        if($errors->has('code')) {
                            $code = old('code');
                        } else {
                            $code = (old('code')) ? old('code') : $vehicle_type->code;
                        }
                        @endphp
                        <x-forms.input-field class="w-full"
                            name="code" type="text"
                            label="Code"
                            placeholder="--"
                            maxlength="5"
                            value="{{ $code }}"
                            required
                        />
                        <div class="w-full"></div>
                    </div>
                    @php
                    if($errors->has('type')) {
                        $type = old('type');
                    } else {
                        $type = (old('type')) ? old('type') : $vehicle_type->type;
                    }
                    @endphp
                    <x-forms.input-field class="w-full"
                        name="type"
                        type="text"
                        label="Vehicle Type"
                        placeholder="--"
                        value="{{ $type }}"
                        required
                    />
                    <div class="flex space-x-2">
                        @php
                        if($errors->has('one_year')) {
                            $one_year = old('one_year');
                        } else {
                            $one_year = (old('one_year')) ? old('one_year') : $vehicle_type->one_year;
                        }
                        @endphp
                        <x-forms.input-field class="w-full"
                            name="one_year"
                            type="number"
                            label="One (1) year coverage"
                            placeholder="--"
                            step="0.1"
                            value="{{ $one_year }}"
                            required
                        />
                        @php
                        if($errors->has('three_years')) {
                            $three_years = old('three_years');
                        } else {
                            $three_years = (old('three_years')) ? old('three_years') : $vehicle_type->three_years;
                        }
                        @endphp
                        <x-forms.input-field class="w-full"
                            name="three_years"
                            type="number"
                            label="Three (3) years coverage"
                            placeholder="--"
                            step="0.1"
                            value="{{ $three_years }}"
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
