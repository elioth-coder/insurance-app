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
            'url' => '/clients/' . $client->id . '/vehicles/' . $vehicle->id . '/insurances/' . $insurance->id,
            'title' => $insurance->coc_number,
        ],
        [
            'url' => '/clients/' . $client->id . '/vehicles/' . $vehicle->id . '/insurances/' . $insurance->id . '/edit',
            'title' => 'Edit ',
        ],
    ]
@endphp

<x-layout :$breadcrumbs>
    <x-card class="mx-auto sm:max-w-xl">
        <x-card-header>Edit vehicle's insurance</x-card-header>
        <x-forms.form action="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}/insurances/{{ $insurance->id }}" method="POST" verb="PATCH">
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="or_number"
                    type="text"
                    label="OR number"
                    placeholder="ex. 12345567890"
                    value="{{$insurance->or_number ?? ''}}"
                />
                <x-forms.input-field
                    class="w-full"
                    name="issue_date"
                    type="date"
                    label="Issue date"
                    value="{{$insurance->issue_date ?? '00-00-0000'}}"
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
                    value="{{$insurance->coc_number ?? ''}}"
                />
                <x-forms.input-field
                    class="w-full"
                    name="policy_number"
                    type="text"
                    label="Policy number"
                    placeholder="ex. 52WVC10338233"
                    value="{{$insurance->policy_number ?? ''}}"
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
                    value="{{$insurance->start_date ?? '00-00-0000'}}"
                />
                <x-forms.input-field
                    class="w-full"
                    name="end_date"
                    type="date"
                    label="To"
                    placeholder=""
                    value="{{$insurance->end_date ?? '00-00-0000'}}"
                />
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="premiums_paid"
                    type="text"
                    label="Premiums paid"
                    placeholder="ex. 690"
                    value="{{$insurance->premiums_paid ?? ''}}"
                />
                <x-forms.input-field
                    class="w-full"
                    name="amount_due"
                    type="text"
                    label="Amount due"
                    placeholder="ex. 1450"
                    value="{{$insurance->amount_due ?? ''}}"
                />
            </section>
            <hr>
            <section class="flex space-x-2">
                <x-forms.button type="submit" color="green">Update</x-forms.button>
                <a href="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}/insurances/{{ $insurance->id }}" class="w-full block">
                    <x-forms.button type="button" color="neutral">Cancel</x-forms.button>
                </a>
            </section>
        </x-forms.form>
    </x-card>
</x-layout>
