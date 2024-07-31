<x-layout>
    <x-page-header>{{ $client->first_name }} {{ $client->last_name }}</x-page-header>

    <x-card class="mx-auto sm:max-w-xl">
        <x-card-header>Register client's vehicle</x-card-header>
        <x-forms.form action="/clients/{{ $client->id }}/vehicles" method="POST">
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="plate_number"
                    type="text"
                    label="Plate number"
                    placeholder="ex. AB 1234"
                />
                <x-forms.input-field
                    class="w-full"
                    name="mv_file_number"
                    type="text"
                    label="MV File number"
                    placeholder="ex. 1301-1234567"
                />
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="chassis_number"
                    type="text"
                    label="Serial/Chassis no."
                    placeholder="ex. ABCDEFGHIJ1234567"
                />
                <x-forms.input-field
                    class="w-full"
                    name="engine_number"
                    type="text"
                    label="Motor/Engine no."
                    placeholder="ex. 52WVC10338"
                />
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="make"
                    type="text"
                    label="Make"
                    placeholder="ex. HONDA, TOYOTA, NISSAN"
                />
                <x-forms.input-field
                    class="w-full"
                    name="model"
                    type="text"
                    label="Model"
                    placeholder="ex. Civic, Jetta, Everest, Nmax"
                />
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="color"
                    type="text"
                    label="Color"
                    placeholder="ex. BLACK, RED, BLUE"
                />
                <x-forms.input-field
                    class="w-full"
                    name="body_type"
                    type="text"
                    label="Body type"
                    placeholder="ex. MC, SEDAN, WAGON, MPV"
                />
            </section>
            <section class="flex space-x-2">
                <x-forms.input-field
                    class="w-full"
                    name="unladen_weight"
                    type="text"
                    label="Unladen Weight (kg)"
                    placeholder="ex. 150, 200"
                />
                <x-forms.input-field
                    class="w-full"
                    name="load_capacity"
                    type="text"
                    label="Load Capacity (kg)"
                    placeholder="ex. 150, 200"
                />
            </section>
            <hr>
            <section class="flex space-x-2">
                <x-forms.button type="submit" color="primary">Register vehicle</x-forms.button>
                <a href="/clients/{{ $client->id }}" class="w-full block">
                    <x-forms.button type="button" color="red">Cancel</x-forms.button>
                </a>
            </section>
        </x-forms.form>
    </x-card>
</x-layout>
