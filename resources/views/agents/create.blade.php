@php
    $breadcrumbs = [
        [
            'url' => '/agents',
            'title' => 'Agents',
        ],
        [
            'url' => '/agents/create',
            'title' => 'Add new',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="w-full pb-6 pt-2">
        <div class="max-w-xl">
            @if (session('message'))
                <x-alerts.success id="alert-agent">
                    {{ session('message') }}
                </x-alerts.success>
            @endif
        </div>
        <x-card class="max-w-xl">
            <x-card-header>Register new Agent</x-card-header>
            <x-forms.form method="POST" action="/agents">
                <div class="flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="first_name"
                        type="text"
                        label="First name"
                        placeholder="Enter first name"
                        required
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="last_name"
                        type="text"
                        label="Last name"
                        placeholder="Enter last name"
                        required
                    />
                </div>
                <x-forms.input-field
                    class="w-full"
                    name="email"
                    type="email"
                    label="Email address"
                    placeholder="Enter email address"
                    required
                />
                <div class="flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="branch"
                        type="text"
                        label="Company/Branch"
                        placeholder="Enter company/branch"
                        required
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="mobile_number"
                        type="text"
                        label="Mobile no."
                        placeholder="Enter mobile no."
                    />
                </div>
                <div class="flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="password"
                        type="password"
                        label="Password"
                        placeholder="••••••••"
                        required
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="password_confirmation"
                        type="password"
                        label="Confirm password"
                        placeholder="••••••••"
                        required
                    />
                </div>
                <div class="flex space-x-2">
                    <x-forms.select-field class="w-full" name="status" label="Status" placeholder="Set status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </x-forms.select-field>
                    <div class="w-full"></div>
                </div>
                <hr class="my-1">
                <div class="flex space-x-2 justify-end">
                    <span class="inline-block w-32">
                        <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                    </span>
                    <a href="/agents" class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                        Back
                    </a>
                </div>
            </x-forms.form>
        </x-card>
    </div>
</x-layout>
