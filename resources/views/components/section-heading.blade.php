@props(['button'])

@php
    $defaults = [
        'class' => 'flex justify-between',
]   ;
@endphp

<div {{ $attributes($defaults) }}>
    <section class="inline-flex items-center space-x-2">
        <span class="w-2 h-2 bg-primary-500 inline-block rounded-full"></span>
        <h3 class="font-bold text-lg">{{ $slot }}</h3>
    </section>
    {{ $button }}
</div>
