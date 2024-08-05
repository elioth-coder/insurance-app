@props(['client','vehicle','view_all'=>true])

<div class="relative overflow-x-auto w-full">
    <div class="flex justify-between">
        <h2 class="text-xl underline mb-4 font-bold">Vehicle's Insurances</h2>
        <section class="flex space-x-1">
            <a href="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}/insurances/create" class="block">
                <x-forms.button color="green" class="w-auto">
                    Add New
                </x-forms.button>
            </a>
            @if ($view_all)
                <a href="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}/insurances" class="block">
                    <x-forms.button color="neutral" class="w-auto">
                        View All
                    </x-forms.button>
                </a>
            @endif
        </section>
    </div>
    <br>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">Insurance Details</th>
                <th scope="col" class="px-6 py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicle->insurances()->get() as $insurance)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        <table>
                            <tr>
                                <td class="px-6 text-lg font-bold">Policy No.</td>
                                <td class="px-6 text-lg">{{ $insurance->policy_number }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 text-lg font-bold">Confirmation of Cover No.</td>
                                <td class="px-6 text-lg">
                                    <a class="hover:underline hover:text-primary-500" href="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}/insurances/{{ $insurance->id }}">
                                        {{ $insurance->coc_number }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 text-lg font-bold">Official Receipt No.</td>
                                <td class="px-6 text-lg">{{ $insurance->or_number }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 font-bold">Issue date</td>
                                <td class="px-6">{{ $insurance->issue_date }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 font-bold">Policy period</td>
                                <td class="px-6">{{ $insurance->start_date }} to {{ $insurance->end_date }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 font-bold">Premiums paid</td>
                                <td class="px-6">{{ $insurance->premiums_paid }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 font-bold">Amount due</td>
                                <td class="px-6">{{ $insurance->amount_due }}</td>
                            </tr>
                        </table>
                    </td>
                    <td class="px-6 py-4 text-center align-baseline">
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
                        <div class="inline-flex rounded-md shadow-sm" role="group">
                            <a title="Edit insurance" href="/clients/{{ $client->id }}/vehicles/{{ $vehicle->id }}/insurances/{{ $insurance->id }}/edit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                </svg>
                            </a>
                            <button title="Delete insurance" type="button" onclick="deleteInsurance({{ $insurance->id }});"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-l-0 border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
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
