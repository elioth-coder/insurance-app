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
    ]
@endphp

<x-layout :$breadcrumbs>
    <x-forms.form
        class="hidden"
        method="POST"
        verb="DELETE"
        action="/clients/{{ $client->id }}"
        id="delete-client-{{ $client->id }}-form">
        <button type="submit">
            Delete
        </button>
    </x-forms.form>

    <div class="mx-auto">
        @if (session('message'))
            <x-alerts.success id="alert-client">
                {{ session('message') }}
            </x-alerts.success>
        @endif
    </div>

    <section class="mx-auto w-auto">
        <x-clients.card-horizontal :$client />
        <div class="mt-5 mx-auto">
            <x-clients.tabs-horizontal :$client />
        </div>
    </section>

    <x-slot:script>
        <script>
            const deleteClient = async (id) => {
                let result = await Swal.fire({
                    title: "Delete this client?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continue"
                });

                if(result.isConfirmed) {
                    document.querySelector(`#delete-client-${id}-form button`).click();
                }
            }

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
                    document.querySelector(`#delete-vehicle-${id}-form button`).click();
                }
            }

        </script>
    </x-slot>
</x-layout>
