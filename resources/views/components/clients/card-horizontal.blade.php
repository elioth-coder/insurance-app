@props(['client'])

@php
    $names = explode(' ', $client->middle_name);
    $initials = collect($names)
        ->map(function ($name) {
            return substr($name, 0, 1) . '.';
        })
        ->join('');
@endphp

<section
    class="mx-auto w-full flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <div class="flex w-full">
        <section class="px-10 flex flex-1 justify-center items-center flex-col rounded-t-lg w-48 rounded-s-lg">
            <div class="rounded-full h-36 w-36 border bg-primary-500/90 flex items-center justify-center">
                <h1 class="text-[75px] font-bold text-gray-300 text-center">
                    {{ substr($client->first_name, 0, 1) }}{{ substr($client->last_name, 0, 1) }}
                </h1>
            </div>
        </section>
        <div class="flex flex-col justify-center p-7 pl-0 leading-normal min-w-96 w-full">
            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $client->first_name }}
                {{ $initials }}@if ($initials)
                @endif
                {{ $client->last_name }}
                {{ $client->suffix ?? '' }}
            </h5>
            <p class="text-gray-500">{{ $client->email }}</p>
            <hr class="my-2">
            <p class="font-normal text-gray-700 dark:text-gray-400">
                <strong class="font-bold">Business/Profession: </strong>
                {{ $client->business ?? '--' }} / {{ $client->profession ?? '--' }}
            </p>
            <p class="font-normal text-gray-700 dark:text-gray-400">
                <strong class="font-bold">Mobile number: </strong>
                {{ $client->mobile_number ?? '--' }}
            </p>
        </div>
    </div>
    <section class="space-x-1 flex px-5 py-4 w-full justify-end bg-gray-100 border-t">
        <div class="inline-flex rounded-md shadow-sm" role="group">
            <a href="/clients/{{ $client->id }}/edit"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border-l border-t border-b border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                </svg>
                Edit
            </a>
            <button type="button" onclick="deleteClient({{ $client->id }});"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                </svg>
                Delete
            </button>
        </div>
    </section>
</section>
