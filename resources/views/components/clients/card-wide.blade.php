@props(['client'])

<x-panel class="flex gap-x-6">
    <div>
        <img src="https://via.placeholder.com/70" alt="" class="rounded-xl" width="70">
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#"
            class="self-start text-sm text-gray-600 transition-colors duration-300">{{ $client->business ?? '--' }} /
            {{ $client->profession ?? '--' }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-primary-800">
            <a href="/clients/{{ $client->id }}">
                {{ $client->last_name }},
                {{ $client->first_name }}
            </a>
        </h3>

        <p class="text-sm text-gray-600 mt-auto">{{ $client->email }}</p>
    </div>

    <div class="space-x-1">
        <a href="/clients/city/{{ strtolower($client->city) }}"
            class="px-5 py-1 text-sm bg-gray-700/10 hover:bg-gray-700/25 rounded-xl font-bold transition-colors duration-300">
            {{ ucwords($client->city) }}
        </a>
        <a href="/clients/province/{{ strtolower($client->province) }}"
            class="px-5 py-1 text-sm bg-gray-700/10 hover:bg-gray-700/25 rounded-xl font-bold transition-colors duration-300">
            {{ ucwords($client->province) }}
        </a>

    </div>
</x-panel>
