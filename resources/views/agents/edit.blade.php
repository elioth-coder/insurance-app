@php
    $breadcrumbs = [
        [
            'url' => '/agents',
            'title' => 'Agents',
        ],
        [
            'url' => '/agents/' . $agent->id,
            'title' => $agent->first_name . ' ' . $agent->last_name,
        ],
        [
            'url' => '/agents/' . $agent->id . '/edit',
            'title' => 'Edit',
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
            <x-card-header>Update Agent Details</x-card-header>
            <x-forms.form action="/agents/{{ $agent->id }}" method="POST" verb="PATCH">
                <div class="flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="first_name"
                        type="text"
                        label="First name"
                        placeholder="Enter first name"
                        value="{{ $agent->first_name ?? '' }}"
                        disabled
                        required
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="last_name"
                        type="text"
                        label="Last name"
                        placeholder="Enter last name"
                        value="{{ $agent->last_name ?? '' }}"
                        disabled
                        required
                    />
                </div>
                <x-forms.input-field
                    class="w-full"
                    name="email"
                    type="email"
                    label="Email address"
                    placeholder="Enter email address"
                    value="{{ $agent->email ?? '' }}"
                    disabled
                    required
                />
                <div class="flex space-x-2">
                    <x-forms.select-field
                        class="w-full"
                        name="branch_id"
                        label="Company/Branch"
                        placeholder="Select company/branch"
                        required>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">
                                {{ $branch->name }} -
                                {{ $branch->address }}
                            </option>
                        @endforeach
                    </x-forms.select-field>
                    <x-forms.input-field
                        class="w-full"
                        name="mobile_number"
                        type="text"
                        label="Mobile no."
                        placeholder="Enter mobile no."
                        value="{{ $agent->mobile_number ?? '' }}"
                        required
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
                        <option value="active" {{ ($agent->status=='active') ? 'selected' : ''}}>Active</option>
                        <option value="inactive" {{ ($agent->status=='inactive') ? 'selected' : ''}}>Inactive</option>
                    </x-forms.select-field>
                    <div class="w-full"></div>
                </div>
                <div class="flex space-x-2 justify-end">
                    <span class="inline-block w-32">
                        <x-forms.button type="submit" color="violet">Update</x-forms.button>
                    </span>
                    <a href="/agents" class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                        Back
                    </a>
                </div>
            </x-forms.form>
        </x-card>
    </div>
</x-layout>
