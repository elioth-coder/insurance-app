@php
    $breadcrumbs = [
        [
            'url' => '/authentication',
            'title' => 'Authentication',
        ],
        [
            'url' => '/authentication/create',
            'title' => 'New',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="w-full pb-6 pt-2">
        <div class="max-w-xl">
            @if (session('message'))
                <x-alerts.success id="alert-authentication">
                    {{ session('message') }}
                </x-alerts.success>
            @endif
        </div>
        <x-card class="max-w-xl">
            <x-card-header>Authentication Details</x-card-header>
            <x-forms.form method="POST" action="/authentication">
                <div class="flex space-x-2">
                    <x-forms.select-field
                        class="w-full"
                        name="type"
                        label="Registration Type"
                        placeholder="Select registration type"
                        required>
                        <option value="new">New</option>
                        <option value="renewal">Renewal</option>
                    </x-forms.select-field>
                    <x-forms.select-field
                        class="w-full"
                        name="lto_mv_type"
                        label="LTO MV Type"
                        placeholder="Select LTO MV Type"
                        required>
                        <option value="C">C -    Car</option>
                        <option value="HB">HB -    Shuttle Bus</option>
                        <option value="LE">LE -    Light Electric Vehicle</option>
                        <option value="M">M -    Motorcycle without Sidecar</option>
                        <option value="MO">MO -    Moped (0-49 cc)</option>
                        <option value="MS">MS -    Motorcycle with Sidecar</option>
                        <option value="NC">NC -    Non-Conventional MC (Car)</option>
                        <option value="NV">NV -    Non-Conventional MV (UV)</option>
                        <option value="OB">OB -    Tourist Bus</option>
                        <option value="SB">SB -    School Bus</option>
                        <option value="SV">SV -    Sports Utility Vehicle</option>
                        <option value="TB">TB -    Truck Bus</option>
                        <option value="TC">TC -    Tricycle</option>
                        <option value="TK">TK -    Truck</option>
                        <option value="TL">TL -    Trailer</option>
                        <option value="UV">UV -    Utility Vehicle</option>
                    </x-forms.select-field>
                </div>
                <hr class="my-1">
                <div class="flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="plate_number"
                        type="text"
                        label="Plate no."
                        placeholder="Enter plate no."
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="mv_file_number"
                        type="text"
                        label="MV File no."
                        placeholder="Enter MV File no."
                    />
                </div>
                <div class="flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="serial_number"
                        type="text"
                        label="Serial/Chassis no."
                        placeholder="Enter serial/chassis no."
                        required
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="engine_number"
                        type="text"
                        label="Motor/Engine no."
                        placeholder="Enter motor/engine no."
                    />
                </div>
                <hr class="my-1">
                <div class="flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="assured_tin"
                        type="text"
                        label="Assured TIN"
                        placeholder="Enter assured TIN"
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="assured_name"
                        type="text"
                        label="Assured Name"
                        placeholder="Enter assured name"
                        required
                    />
                </div>
                <x-forms.textarea-field
                    name="assured_address"
                    label="Assured address"
                    placeholder="Enter assured address"
                    required
                />
                <div class="flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="contact_number"
                        type="text"
                        label="Contact No."
                        placeholder="Enter contact no."
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="email_address"
                        type="email"
                        label="Email Address"
                        placeholder="Enter email address"
                    />
                </div>
                <hr class="my-1">
                <x-forms.input-field
                    class="w-full"
                    name="or_number"
                    type="text"
                    label="O.R. No."
                    placeholder="Enter O.R. no."
                    required
                />
                <div class="flex space-x-2">
                    {{-- <x-forms.input-field
                        class="w-full"
                        name="coc_number"
                        type="text"
                        label="COC No."
                        placeholder="Enter COC no."
                        required
                    /> --}}
                    <x-forms.select-field
                        class="w-full"
                        name="coc_number"
                        label="COC No."
                        placeholder="Select COC no."
                        required>
                        @foreach ($seriesNumbers as $series)
                            <option value="{{ $series->series_number }}">{{ $series->series_number }}</option>
                        @endforeach
                    </x-forms.select-field>
                    <x-forms.input-field
                        class="w-full"
                        name="policy_number"
                        type="text"
                        label="Policy No."
                        placeholder="Enter Policy no."
                        required
                    />
                </div>
                <x-forms.select-field
                    class="w-full"
                    name="vehicle_type"
                    label="Vehicle Type"
                    placeholder="Select vehicle type"
                    required>
                    <option value="1">1 - Private Cars (including jeeps and AUVs) - 1 -Year(s) - 560.00</option>
                    <option value="2">2 - Light Medium Trucks (Own Goods) Not over 3,930 kgs. - 1 -Year(s) - 610.00</option>
                    <option value="3">3 - Heavy Trucks (Own Good), Private Buses over 3,930 kgs. - 1 -Year(s) - 1,200.00</option>
                    <option value="4">4 - AC and Tourists Cars - 1 -Year(s) - 740.00</option>
                    <option value="5">5 - Taxi, PUJ and Mini bus - 1 -Year(s) - 1,100.00</option>
                    <option value="6">6 - PUB and Tourists Bus - 1 -Year(s) - 1,450.00</option>
                    <option value="7">7 - Motorcycles/Tricycles/Trailers - 1 -Year(s) - 250.00</option>
                    <option value="8">8 - Private Cars (including jeeps and AUVs) - 3 -Year(s) - 1,610.00</option>
                    <option value="9">9 - Light Medium Trucks (Own Goods) Not over 3,930 kgs. - 3 -Year(s) - 1,750.00</option>
                    <option value="10">10 - Heavy Trucks (Own Good), Private Buses over 3,930 kgs. - 3 -Year(s) - 3,440.00</option>
                    <option value="11">11 - AC and Tourists Cars - 3 -Year(s) - 2,120.00</option>
                    <option value="12">12 - Taxi, PUJ and Mini bus - 3 -Year(s) - 3,150.00</option>
                    <option value="13">13 - PUB and Tourists Bus - 3 -Year(s) - 4,150.00</option>
                    <option value="14">14 - Motorcycles/Tricycles/Trailers - 3 -Year(s) - 720.00</option>
                </x-forms.select-field>
                <div class="flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="inception_date"
                        type="date"
                        label="Inception Date From"
                        placeholder="00-00-0000"
                        required
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="expiry_date"
                        type="date"
                        label="Expiry Date To"
                        placeholder="00-00-0000"
                        required
                    />
                </div>
                <hr class="my-1">
                <div class="flex space-x-2 justify-end">
                    <span class="inline-block w-32">
                        <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                    </span>
                    <a href="/subagents" class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                        Back
                    </a>
                </div>
            </x-forms.form>
        </x-card>
    </div>
</x-layout>
