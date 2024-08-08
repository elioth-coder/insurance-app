@php
    $breadcrumbs = [
        [
            'url' => '/subagents',
            'title' => 'Subagents',
        ],
        [
            'url' => '/subagents/' . $subagent->id,
            'title' => $subagent->first_name . ' ' . $subagent->last_name,
        ],
        [
            'url' => '/subagents/' . $subagent->id . '/edit',
            'title' => 'Edit',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="w-full pb-6 pt-2">
        <div class="max-w-xl">
            @if (session('message'))
                <x-alerts.success id="alert-subagent">
                    {{ session('message') }}
                </x-alerts.success>
            @endif
        </div>
        <x-card class="max-w-xl">
            <x-card-header>Register new Subagent</x-card-header>
            <x-forms.form action="/subagents/{{ $subagent->id }}" method="POST" verb="PATCH">
                <div class="flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="first_name"
                        type="text"
                        label="First name"
                        placeholder="Enter first name"
                        value="{{ $subagent->first_name ?? '' }}"
                        disabled
                        required
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="last_name"
                        type="text"
                        label="Last name"
                        placeholder="Enter last name"
                        value="{{ $subagent->last_name ?? '' }}"
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
                    value="{{ $subagent->email ?? '' }}"
                    disabled
                    required
                />
                <div class="flex space-x-2">
                    <x-forms.input-field
                        class="w-full"
                        name="branch"
                        type="text"
                        label="Branch"
                        placeholder="Enter branch"
                        value="{{ $subagent->branch ?? '' }}"
                        required
                    />
                    <x-forms.input-field
                        class="w-full"
                        name="mobile_number"
                        type="text"
                        label="Mobile no."
                        placeholder="Enter mobile no."
                        value="{{ $subagent->mobile_number ?? '' }}"
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
                        <option value="active" {{ ($subagent->status=='active') ? 'selected' : ''}}>Active</option>
                        <option value="inactive" {{ ($subagent->status=='inactive') ? 'selected' : ''}}>Inactive</option>
                    </x-forms.select-field>
                    <div class="w-full"></div>
                </div>
                <div class="flex space-x-2 justify-end">
                    <span class="inline-block w-44">
                        <x-forms.button type="submit" color="primary">Submit</x-forms.button>
                    </span>

                </div>
            </x-forms.form>
        </x-card>
    </div>
</x-layout>
