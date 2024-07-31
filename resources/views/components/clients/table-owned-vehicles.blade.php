@props(['client'])

<div class="relative overflow-x-auto w-full">
    <div class="flex justify-between">
        <h2 class="text-xl underline mb-4 font-bold">Client's Owned Vehicles</h2>
        <a href="/clients/{{ $client->id }}/vehicles/create" class="block">
            <x-forms.button color="green" class="w-auto">
                Add Vehicle
            </x-forms.button>
        </a>
    </div>
    <br>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Make & Model</th>
                <th scope="col" class="px-6 py-3">Body Type</th>
                <th scope="col" class="px-6 py-3">Color</th>
                <th scope="col" class="px-6 py-3">Plate No.</th>
                <th scope="col" class="px-6 py-3">Serial/Chassis No.</th>
                <th scope="col" class="px-6 py-3 text-center">Action</th>
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
                    <td class="px-6 py-4 text-center">
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
                        <div class="inline-flex rounded-md shadow-sm" role="group">
                            <a href="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}/edit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border-l border-t border-b border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                </svg>
                            </a>
                            <button type="button" onclick="deleteVehicle({{ $vehicle->id }});"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
