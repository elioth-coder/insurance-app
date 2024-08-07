@php
    $breadcrumbs = [
        [
            'url' => '/clients',
            'title' => 'Clients',
        ],
        [
            'url' => '/clients/create',
            'title' => 'Add new',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="mx-auto sm:max-w-xl">
        @if (session('message'))
            <x-alerts.success id="alert-client">
                {{ session('message') }}
                Check <a href="{{ session('url') }}" class="font-semibold underline hover:no-underline">here</a>.
            </x-alerts.success>
        @endif
    </div>
    <x-card class="mx-auto sm:max-w-xl">
        <x-card-header>Fill out new client details</x-card-header>
        <x-forms.form action="/clients" method="POST">
            <section class="flex space-x-2">
                <x-forms.input-field class="w-full" name="first_name" type="text" label="First name"
                    placeholder="ex. Juan" />
                <x-forms.input-field class="w-full" name="last_name" type="text" label="Last name"
                    placeholder="ex. Dela Cruz" />
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field class="w-full" name="middle_name" type="text" label="Middle name"
                    placeholder="ex. Manuel" />
                <section class="w-full flex space-x-2">
                    <x-forms.input-field class="w-full" name="suffix" type="text" label="Suffix"
                        placeholder="ex. Jr., Sr., II" />
                    <x-forms.select-field class="w-full" name="gender" label="Gender" placeholder="Set gender">
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                    </x-forms.select-field>
                </section>
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field class="w-full" name="birthday" type="date" label="Birthday"
                    placeholder="mm/dd/yyyy" />
                <x-forms.input-field class="w-full" name="email" type="email" label="Email"
                    placeholder="ex. name@company.com" />
            </section>
            <hr>
            <section class="flex space-x-2">
                <x-forms.input-field class="w-full" name="mobile_number" type="text" label="Mobile no."
                    placeholder="ex. 09XX-XXX-XXXX" />
                <x-forms.input-field class="w-full" name="tin_number" type="text" label="TIN no."
                    placeholder="ex. 000-000-000-00000" />
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field class="w-full" name="business" type="text" label="Business"
                    placeholder="ex. Construction Company" />
                <x-forms.input-field class="w-full" name="profession" type="text" label="Profession"
                    placeholder="ex. Engineer" />
            </section>
            <hr>
            <section class="flex space-x-2">
                <x-forms.input-field class="w-full" name="province" type="text" label="Province"
                    placeholder="ex. Nueva Ecija" />
                <x-forms.input-field class="w-full" name="city" type="text" label="City"
                    placeholder="ex. Cabanatuan" />
            </section>
            <x-forms.textarea-field name="address" label="Address Line"
                placeholder="ex. Rizal St. Brgy. Poblacion Central" />
            <section class="flex space-x-2">
                <x-forms.button type="submit" color="green">Save</x-forms.button>
                <a href="/clients" class="w-full block">
                    <x-forms.button type="button" color="neutral">Cancel</x-forms.button>
                </a>
            </section>
        </x-forms.form>
    </x-card>
</x-layout>
