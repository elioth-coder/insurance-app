@php
    $breadcrumbs = [
        [
            'url' => '/clients',
            'title' => 'Clients',
        ],
    ]
@endphp

<x-layout :$breadcrumbs>
    <div class="mx-auto max-w-4xl">
        @if (session('message'))
            <x-alerts.success id="alert-client">
                {{ session('message') }}
            </x-alerts.success>
        @endif
    </div>
    <div class="space-y-10 mx-auto max-w-4xl">
        <section>
            <x-section-heading class="relative w-full">
                Recent Clients
                <x-slot:button>
                    <a href="/clients/create" class="block">
                        <x-forms.button color="green" class="w-auto">
                            Add New
                        </x-forms.button>
                    </a>
                </x-slot:button>
            </x-section-heading>

            <div class="mt-6 space-y-6">
                @foreach($clients as $client)
                    <x-clients.card-wide :$client />
                @endforeach
            </div>
        </section>
    </div>
</x-layout>
