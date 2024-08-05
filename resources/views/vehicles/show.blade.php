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
    ]
@endphp

<x-layout :$breadcrumbs>
    <x-forms.form
        class="hidden"
        method="POST"
        verb="DELETE"
        action="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}"
        id="delete-vehicle-{{ $vehicle->id }}-form">
        <button type="submit">
            Delete
        </button>
    </x-forms.form>

    <div class="mx-auto max-w-4xl">
        @if (session('message'))
            <x-alerts.success id="alert-client">
                {{ session('message') }}
            </x-alerts.success>
        @endif
    </div>

    <x-vehicles.card-horizontal :$client :$vehicle />
    <div class="max-w-4xl mt-5 mx-auto">
        <x-vehicles.tabs-horizontal :$client :$vehicle />
    </div>


    <x-slot:script>
        <script>
            const deleteVehicle = async (id) => {
                let result = await Swal.fire({
                    title: "Delete this vehicle?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continue"
                });

                if(result.isConfirmed) {
                    let button = document.querySelector(`#delete-vehicle-${id}-form button`);
                    console.log(button);
                    button.click();
                }
            }

            const deleteInsurance = async (id) => {
                let result = await Swal.fire({
                    title: "Delete this insurance?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continue"
                });

                if(result.isConfirmed) {
                    document.querySelector(`#delete-insurance-${id}-form button`).click();
                }
            }
        </script>
    </x-slot>
</x-layout>
