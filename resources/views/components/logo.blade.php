@php
    $defaults = [
        'class' => 'w-8 h-8',
    ];
@endphp

<img {{ $attributes($defaults) }} src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo">
