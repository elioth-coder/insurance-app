@props(['client'])

<div class="relative overflow-x-auto w-full">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Make & Model</th>
                <th scope="col" class="px-6 py-3">Body Type</th>
                <th scope="col" class="px-6 py-3">Color</th>
                <th scope="col" class="px-6 py-3">Plate No.</th>
                <th scope="col" class="px-6 py-3">Serial/Chassis No.</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($client->vehicles()->get() as $vehicle)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$vehicle->make}} {{$vehicle->model}}
                    </th>
                    <td class="px-6 py-4">{{ $vehicle->body_type }}</td>
                    <td class="px-6 py-4">{{ $vehicle->color }}</td>
                    <td class="px-6 py-4">{{ $vehicle->plate_number ?? '--' }}</td>
                    <td class="px-6 py-4">{{ $vehicle->chassis_number }}</td>
                    <td>
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

                        <a class="w-fit inline-block" href="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}/edit">
                            <x-forms.button-icon color="primary" class="w-auto">
                                <x-slot:icon>
                                    <x-icons.solid.pen class="text-white w-3.5 h-3.5" />
                                </x-slot:icon>
                            </x-forms.button-icon>
                        </a>
                        <x-forms.button-icon
                            onclick="deleteVehicle({{ $vehicle->id }});"
                            color="red"
                            class="w-auto">
                            <x-slot:icon>
                                <x-icons.solid.trash-bin class="text-white w-3.5 h-3.5" />
                            </x-slot:icon>
                        </x-forms.button-icon>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
