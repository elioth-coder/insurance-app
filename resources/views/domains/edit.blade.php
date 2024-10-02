@php
    $breadcrumbs = [
        [
            'url' => '/settings',
            'title' => 'Application Settings',
        ],
        [
            'url' => '/settings/domains',
            'title' => 'Allowed Domains',
        ],
        [
            'url' => "/settings/domains/$domain->id",
            'title' => $domain->host,
        ],
        [
            'url' => "/settings/domains/$domain->id/edit",
            'title' => 'Edit',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="flex space-x-3 min-h-screen">
        <div class="w-3/5 pb-6 pt-2">
            <div class="max-w-xl">
                @if (session('message'))
                    <x-alerts.success id="alert-domain">
                        {{ session('message') }}
                    </x-alerts.success>
                @endif
            </div>
            <x-card class="max-w-xl">
                <x-card-header>Edit Domain</x-card-header>
                <x-forms.form method="POST" action="/settings/domains/{{ $domain->id }}" verb="PATCH">
                    @php
                    if($errors->has('name')) {
                        $name = old('name');
                    } else {
                        $name = (old('name')) ? old('name') : $domain->name;
                    }
                    @endphp
                    <x-forms.input-field class="w-full"
                        name="name"
                        type="text"
                        label="Name of System"
                        placeholder="--"
                        value="{{ $name }}"
                        required
                    />
                    @php
                    if($errors->has('host')) {
                        $host = old('host');
                    } else {
                        $host = (old('host')) ? old('host') : $domain->host;
                    }
                    @endphp
                    <x-forms.input-field class="w-full"
                        name="host"
                        type="text"
                        label="Host or Domain"
                        placeholder="--"
                        value="{{ $host }}"
                        required
                    />
                    <hr class="my-1">
                    <div class="flex space-x-2 justify-end">
                        <span class="inline-block w-32">
                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                        </span>
                        <a href="/settings/domains"
                            class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                            Back
                        </a>
                    </div>
                </x-forms.form>
            </x-card>
        </div>
        <div class="w-2/5 pb-6 pt-2">
            <section class="bg-violet-500 text-white p-8 rounded-lg">
                <h2 class="mb-2 text-lg font-semibold dark:text-white">IMPORTANT NOTES:</h2>
                <ul class="max-w-md space-y-1 list-disc list-inside dark:text-gray-400">
                    <li>
                        Only add legitimate external sytems and valid domains
                    </li>
                </ul>
            </section>
        </div>
    </div>
</x-layout>
