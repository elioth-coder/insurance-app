@props(['client'])

@php
    $names = explode(' ', $client->middle_name);
    $initials = collect($names)
        ->map(function ($name) {
            return substr($name, 0, 1);
        })
        ->join('.');
@endphp

<section
    class="mx-auto w-full flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow max-w-4xl dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <div class="flex w-full">
        <section
            class="px-10 pt-5 flex items-center flex-col rounded-t-lg h-full w-48 rounded-s-lg">
            <div class="rounded-full h-36 w-36 border bg-primary-500/90 flex items-center justify-center">
                <h1 class="text-[75px] font-bold text-gray-300 text-center">
                    {{ substr($client->first_name, 0, 1) }}{{ substr($client->last_name, 0, 1) }}
                </h1>
            </div>
        </section>
        <div class="flex flex-col justify-center p-10 pl-0 leading-normal min-w-96 w-full">
            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $client->first_name }}
                {{ $initials }}@if ($initials).@endif
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
        <a href="/clients/{{ $client->id }}/vehicles/create">
            <x-forms.button-icon color="green" class="w-24">
                <x-slot:icon>
                    <x-icons.outline.plus class="text-white mr-1 w-3.5 h-3.5" />
                </x-slot:icon>
                Vehicle
            </x-forms.button-icon>
        </a>
        <a href="/clients/{{ $client->id }}/edit">
            <x-forms.button-icon color="primary" class="w-24">
                <x-slot:icon>
                    <x-icons.solid.pen class="text-white mr-1 w-3.5 h-3.5" />
                </x-slot:icon>
                Edit
            </x-forms.button-icon>
        </a>
        <x-forms.button-icon class="w-24" onclick="deleteClient({{ $client->id }});" color="red">
            <x-slot:icon>
                <x-icons.solid.trash-bin class="text-white mr-1 w-3.5 h-3.5" />
            </x-slot:icon>
            Delete
        </x-forms.button-icon>
    </section>
</section>
