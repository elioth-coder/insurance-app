@php
    $classes = 'p-4 bg-white rounded-xl border border-transparent hover:border-primary-800 group transition-colors duration-300';
@endphp

<div {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</div>
