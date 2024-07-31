<x-layout>
    <x-page-header>Clients</x-page-header>
    <div class="space-y-10">
        <section>
            <x-section-heading class="relative w-full">
                Recent Clients
                <x-slot:button>
                    <a href="/clients/create" class="block">
                        <x-forms.button color="green" class="w-auto">
                            Add Client
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
