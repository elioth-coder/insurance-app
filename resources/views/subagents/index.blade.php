@php
    $breadcrumbs = [
        [
            'url' => '/subagents',
            'title' => 'Subagents',
        ]
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="mx-auto max-w-4xl">
        @if (session('message'))
            <x-alerts.success id="alert-subagent">
                {{ session('message') }}
            </x-alerts.success>
        @endif
    </div>

    <div class="flex">
        <div class="w-full max-w-4xl mt-5 mx-auto">
            <x-clients.table-owned-vehicles :$client :$view_all />
        </div>
    </div>

    <x-slot:script>
        <script>

        </script>
    </x-slot>
</x-layout>
