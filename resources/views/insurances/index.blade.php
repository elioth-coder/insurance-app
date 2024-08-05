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
            'title' => 'Insurances',
        ],
    ];

    $view_all = false;
@endphp

<x-layout :$breadcrumbs>
    <div class="mx-auto max-w-4xl">
        @if (session('message'))
            <x-alerts.success id="alert-vehicle">
                {{ session('message') }}
            </x-alerts.success>
        @endif
    </div>

    <div class="flex">
        <div class="w-full max-w-4xl mt-5 mx-auto">
            <x-vehicles.table-vehicle-insurances :$client :$vehicle :$view_all />
        </div>
    </div>

    <x-slot:script>
        <script>
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
