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
    <div class="flex space-x-3 min-h-screen">
        <div class="w-3/5 pb-6 pt-2">
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
                    <x-forms.input-field
                        value="{{ request()->serial ?? '' }}"
                        class="w-full" name="coc_number" type="text" label="COC serial number"
                        placeholder="--" required />

                    <hr class="my-1">
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full" name="plate_number" type="text" label="Plate number"
                            placeholder="--" />
                        <x-forms.input-field class="w-full" name="mv_file_number" type="text" label="MV File number"
                            placeholder="--" />
                    </div>
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full" name="serial_number" type="text"
                            label="Serial/Chassis number" placeholder="--" required />
                        <x-forms.input-field class="w-full" name="engine_number" type="text"
                            label="Motor/Engine number" placeholder="--" />
                    </div>
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full" name="model" type="text" label="Model"
                            placeholder="--" />
                        <x-forms.input-field class="w-full" name="year" type="text" label="Year"
                            placeholder="--" />
                    </div>
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full" name="make" type="text"
                            label="Make" placeholder="--" required />
                        <x-forms.input-field class="w-full" name="color" type="text"
                            label="Color" placeholder="--" />
                    </div>
                    <hr class="my-1">
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full" name="assured_tin" type="text" label="Assured TIN"
                            placeholder="--" />
                        <x-forms.input-field class="w-full" name="assured_name" type="text" label="Assured name"
                            placeholder="--" required />
                    </div>
                    <x-forms.textarea-field name="assured_address" label="Assured address" placeholder="--" required />
                    <div class="flex space-x-2">
                        <x-forms.input-field class="w-full" name="contact_number" type="text" label="Contact number"
                            maxlength="11" placeholder="--" />
                        <x-forms.input-field class="w-full" name="email_address" type="email" label="Email address"
                            placeholder="--" />
                    </div>
                    <hr class="my-1">
                    <x-forms.select-field class="w-full" name="vehicle_type" label="Type of Vehicle (Premium Rate)"
                        placeholder="Select vehicle type" required>
                        @foreach ($vehicle_types as $vehicle_type)
                            <option value="{{ $vehicle_type->code }}">
                                {{ $vehicle_type->code }} -
                                {{ $vehicle_type->type }} -
                                (P{{ number_format($vehicle_type->one_year, 2) }} |
                                P{{ number_format($vehicle_type->three_years, 2) }})
                            </option>
                        @endforeach
                    </x-forms.select-field>
                    <div class="flex space-x-2">
                        <x-forms.select-field class="w-full" name="coverage" label="Coverage"
                            placeholder="Select coverage" required>
                            <option value="1">One (1) year</option>
                            <option value="3">Three (3) years</option>
                        </x-forms.select-field>
                        <x-forms.input-field class="w-full" name="inception_date" type="date"
                            value="{{ date('Y-m-d') }}" label="Inception Date From" placeholder="00-00-0000" required />
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
                <h2 class="mb-2 text-lg font-semibold dark:text-white">IMPORTANT NOTES: </h2>
                <ul class="max-w-md space-y-1 list-disc list-inside dark:text-gray-400">
                    <li>Only use valid serial numbers for authentication.</li>
                </ul>
            </section>
        </div>
    </div>
    <x-slot:script>
        <script>
            async function checkSerial(serial) {
                let formData = new FormData();
                formData.set('serial', serial);

                let response = await fetch("/api/authentication/check_serial", {
                    method: 'POST',
                    body: formData,
                });
                let {
                    status,
                    message
                } = await response.json();

                if (status == 'error') {
                    await Swal.fire({
                        title: "Error!",
                        text: message,
                        icon: "error",
                        showConfirmButton: false,
                    });
                }
            }

            async function autoFill(criteria, data) {
                let formData = new FormData();
                formData.set(criteria, data);
                formData.set('criteria', criteria);

                let response = await fetch('/api/authentication/vehicle', {
                    method: 'POST',
                    body: formData,
                });
                let {
                    authentication
                } = await response.json();

                document.getElementById('assured_tin').value = authentication.assured_tin;
                document.getElementById('assured_name').value = authentication.assured_name;
                document.getElementById('assured_address').value = authentication.assured_address;
                document.getElementById('contact_number').value = authentication.contact_number;
                document.getElementById('email_address').value = authentication.email_address;
                document.getElementById('serial_number').value = authentication.serial_number;
                document.getElementById('engine_number').value = authentication.engine_number;
                document.getElementById('vehicle_type').value = authentication.vehicle_type;
                document.getElementById('model').value = authentication.model;
                document.getElementById('year').value = authentication.year;
                document.getElementById('make').value = authentication.make;
                document.getElementById('color').value = authentication.color;

                if (criteria == 'mv_file_number') {
                    document.getElementById('plate_number').value = authentication.plate_number;
                }
                if (criteria == 'plate_number') {
                    document.getElementById('mv_file_number').value = authentication.mv_file_number;
                }

            }

            (function() {
                document.getElementById(`mv_file_number`).onkeydown = async (e) => {
                    if (e.key === 'Enter' || e.keyCode === 13) {
                        autoFill('mv_file_number', e.target.value);
                    }
                };
                document.getElementById(`plate_number`).onkeydown = async (e) => {
                    if (e.key === 'Enter' || e.keyCode === 13) {
                        autoFill('plate_number', e.target.value);
                    }
                };
                document.getElementById(`coc_number`).onkeydown = async (e) => {
                    if (e.key === 'Enter' || e.keyCode === 13) {
                        checkSerial(e.target.value);
                    }
                };

                @if (session('id'))
                    window.open('/authentication/{{ session('id') }}/print', '_blank');
                @endif
            })()
        </script>
    </x-slot>
</x-layout>
