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
    ]
@endphp

<x-layout :$breadcrumbs>
    <x-forms.form
        class="hidden"
        method="POST"
        verb="DELETE"
        action="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}/insurances/{{ $insurance->id }}"
        id="delete-insurance-{{ $insurance->id }}-form">
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

    <x-insurances.card-horizontal :$client :$vehicle :$insurance />

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
