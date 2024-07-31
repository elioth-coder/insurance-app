<x-layout>
    <x-page-header>Edit details of {{ $client->first_name }} {{ $client->last_name }}</x-page-header>
    <x-card class="mx-auto sm:max-w-xl">
        <x-card-header>Edit client details</x-card-header>
        <x-forms.form action="/clients/{{ $client->id }}" method="POST" verb="PATCH">
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="last_name"
                    type="text"
                    label="Last name"
                    placeholder="ex. Dela Cruz"
                    value="{{ $client->last_name ?? '' }}"
                />
                <x-forms.input-field
                    class="w-full"
                    name="first_name"
                    type="text"
                    label="First name"
                    placeholder="ex. Juan"
                    value="{{ $client->first_name ?? '' }}"
                />
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="middle_name"
                    type="text"
                    label="Middle name"
                    placeholder="ex. Manuel"
                    value="{{ $client->middle_name ?? '' }}"
                />
                <section class="w-full flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="suffix"
                        type="text"
                        label="Suffix"
                        placeholder="ex. Jr., Sr., II"
                        value="{{ $client->suffix ?? '' }}"
                    />
                    <x-forms.select-field
                        class="w-full"
                        name="gender"
                        label="Gender"
                        placeholder="Set gender">
                        <option {{ $client->gender=='MALE' ? 'selected' : '' }} value="MALE">Male</option>
                        <option {{ $client->gender=='FEMALE' ? 'selected' : '' }} value="FEMALE">Female</option>
                    </x-forms.select-field>
                </section>
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="birthday"
                    type="date"
                    label="Birthday"
                    placeholder="mm/dd/yyyy"
                    value="{{ $client->birthday ?? '' }}"
                />
                <x-forms.input-field
                    class="w-full"
                    name="email"
                    type="email"
                    label="Email"
                    placeholder="ex. name@company.com"
                    value="{{ $client->email ?? '' }}"
                />
            </section>
            <hr>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="mobile_number"
                    type="text"
                    label="Mobile no."
                    placeholder="ex. 09XX-XXX-XXXX"
                    value="{{ $client->mobile_number ?? '' }}"
                />
                <x-forms.input-field
                    class="w-full"
                    name="tin_number"
                    type="text"
                    label="TIN no."
                    placeholder="ex. 000-000-000-00000"
                    value="{{ $client->tin_number ?? '' }}"
                />
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="business"
                    type="text"
                    label="Business"
                    placeholder="ex. Construction Company"
                    value="{{ $client->business ?? '' }}"
                />
                <x-forms.input-field
                    class="w-full"
                    name="profession"
                    type="text"
                    label="Profession"
                    placeholder="ex. Engineer"
                    value="{{ $client->profession ?? '' }}"
                />
            </section>
            <hr>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="province"
                    type="text"
                    label="Province"
                    placeholder="ex. Nueva Ecija"
                    value="{{ $client->province ?? '' }}"
                />
                <x-forms.input-field
                    class="w-full"
                    name="city"
                    type="text"
                    label="City"
                    placeholder="ex. Cabanatuan"
                    value="{{ $client->city ?? '' }}"
                />
            </section>
            <x-forms.textarea-field
                name="address"
                label="Address Line"
                placeholder="ex. Rizal St. Brgy. Poblacion Central"
                value="{{ $client->address ?? '' }}"
            />
            <hr>
            <section class="flex space-x-2">
                <x-forms.button type="submit" color="primary">Update client</x-forms.button>
                <a href="/clients/{{ $client->id }}" class="w-full block">
                    <x-forms.button type="button" color="red">Cancel</x-forms.button>
                </a>
            </section>
        </x-forms.form>
    </x-card>
</x-layout>
