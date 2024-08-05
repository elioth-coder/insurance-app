@php
    $names = explode(' ', $client->first_name);
    $initials = collect($names)
        ->map(function ($name) {
            return substr($name, 0, 1) . '.';
        })
        ->join('');

    $breadcrumbs = [
        [
            'url' => '/clients',
            'title' => 'Clients',
        ],
        [
            'url' => '/clients/' . $client->id,
            'title' => $initials . ' ' . $client->last_name,
        ],
        [
            'url' => '/clients/' . $client->id . '/vehicles',
            'title' => 'Vehicles',
        ],
        [
            'url' => '/clients/' . $client->id . '/vehicles/' . $vehicle->id,
            'title' => ucfirst(strtolower($vehicle->make)) . ' ' . ucfirst(strtolower($vehicle->model)),
        ],
        [
            'url' => '/clients/' . $client->id . '/vehicles/' . $vehicle->id . '/insurances',
            'title' => 'Insurances ',
        ],
        [
            'url' => '/clients/' . $client->id . '/vehicles/' . $vehicle->id . '/insurances/create',
            'title' => 'Add new ',
        ],
    ]
@endphp

<x-layout :$breadcrumbs>
    <div class="mx-auto sm:max-w-xl">
        @if (session('message'))
            <x-alerts.success id="alert-insurance">
                {{ session('message') }}
                Check <a href="{{ session('url') }}" class="font-semibold underline hover:no-underline">here</a>.
            </x-alerts.success>
        @endif
    </div>
    <x-card class="mx-auto sm:max-w-xl">
        <x-card-header>Add vehicle's insurance</x-card-header>
        <x-forms.form action="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}/insurances" method="POST">
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="or_number"
                    type="text"
                    label="OR number"
                    placeholder="ex. 12345567890"
                />
                <x-forms.input-field
                    class="w-full"
                    name="issue_date"
                    type="date"
                    label="Issue date"
                    placeholder=""
                />
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="coc_number"
                    type="text"
                    label="COC number"
                    placeholder="ex. ABC12345678"
                />
                <x-forms.input-field
                    class="w-full"
                    name="policy_number"
                    type="text"
                    label="Policy number"
                    placeholder="ex. 52WVC10338233"
                />
            </section>
            <section class="w-full"><label>Policy Period</label></section>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="start_date"
                    type="date"
                    label="From"
                    placeholder=""
                />
                <x-forms.input-field
                    class="w-full"
                    name="end_date"
                    type="date"
                    label="To"
                    placeholder=""
                />
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="premiums_paid"
                    type="text"
                    label="Premiums paid"
                    placeholder="ex. 690"
                />
                <x-forms.input-field
                    class="w-full"
                    name="amount_due"
                    type="text"
                    label="Amount due"
                    placeholder="ex. 1450"
                />
            </section>
            <hr>
            <section class="flex space-x-2">
                <x-forms.button type="submit" color="green">Save</x-forms.button>
                <a href="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}/insurances" class="w-full block">
                    <x-forms.button type="button" color="neutral">Cancel</x-forms.button>
                </a>
            </section>
        </x-forms.form>
    </x-card>
</x-layout>
