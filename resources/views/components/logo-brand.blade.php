@props(['size'=>'58px'])

@php
    $defaults = [
        'class' => 'flex items-center text-2xl font-semibold text-gray-900 dark:text-white'
    ];
@endphp

<a href="/" {{ $attributes($defaults) }}>
    <x-logo class="w-[{{ $size }}] h-[{{ $size }}] mr-2" />
    @if ($slot->isEmpty())
        Car Ensure
    @else
        {{ $slot }}
    @endif
</a>
