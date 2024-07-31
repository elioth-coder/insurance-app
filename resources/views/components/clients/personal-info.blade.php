@props(['client'])

<section class="w-full">
    <h2 class="text-xl underline mb-4 font-bold">Client's Personal Information</h2>
    @php
        $names = explode(' ', $client->middle_name);
        $initials = collect($names)
            ->map(function ($name) {
                return substr($name, 0, 1);
            })
            ->join('.');
    @endphp
    <p><strong class="font-bold w-24 inline-block">Full name:</strong>{{ $client->first_name }}
        {{ $initials }}@if ($initials).@endif
        {{ $client->last_name }}
        {{ $client->suffix ?? '' }}
    </p>
    <p><strong class="font-bold w-24 inline-block">Profession: </strong>{{ $client->profession ?? '--' }}</p>
    <p><strong class="font-bold w-24 inline-block">Gender:</strong>{{ $client->gender }}</p>
    <p><strong class="font-bold w-24 inline-block">Birthday:</strong>{{ $client->birthday }}</p>
    <p><strong class="font-bold w-24 inline-block">Address:</strong>{{ $client->address ? $client->address . ',' : '' }}
        {{ $client->city }}, {{ $client->province }}</p>
    <hr class="my-2">
    <p><strong class="font-bold w-24 inline-block">Business: </strong>{{ $client->business ?? '--' }}</p>
    <p><strong class="font-bold w-24 inline-block">TIN no.:</strong>{{ $client->tin_number ?? '--' }}</p>
    <p><strong class="font-bold w-24 inline-block">Mobile no.:</strong>{{ $client->mobile_number ?? '--' }}</p>
    <p><strong class="font-bold w-24 inline-block">Email:</strong>{{ $client->email }}</p>
</section>
