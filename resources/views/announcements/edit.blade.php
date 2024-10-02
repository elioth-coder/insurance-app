@php
    $breadcrumbs = [
        [
            'url' => '/settings',
            'title' => 'Application Settings',
        ],
        [
            'url' => '/settings/announcements',
            'title' => 'Announcements',
        ],
        [
            'url' => "/settings/announcements/$announcement->id",
            'title' => $announcement->id,
        ],
        [
            'url' => "/settings/announcements/$announcement->id/edit",
            'title' => 'Edit',
        ],
    ];
@endphp

<x-layout :$breadcrumbs>
    <div class="flex space-x-3 min-h-screen">
        <div class="w-3/5 pb-6 pt-2">
            <div class="max-w-xl">
                @if (session('message'))
                    <x-alerts.success id="alert-announcements">
                        {{ session('message') }}
                    </x-alerts.success>
                @endif
            </div>
            <x-card class="max-w-xl">
                <x-card-header>Edit Vehicle Type</x-card-header>
                <x-forms.form method="POST" action="/settings/announcements/{{ $announcement->id }}" verb="PATCH">
                    <div class="flex space-x-2">
                        @php
                        if($errors->has('color')) {
                            $color = old('color');
                        } else {
                            $color = (old('color')) ? old('color') : $announcement->color;
                        }
                        @endphp
                        <x-forms.select-field class="w-full"
                            name="color"
                            label="Color"
                            placeholder="Select color"
                            required>
                            <option {{ ($color=='gray') ? 'selected' : ''}} value="gray">GRAY</option>
                            <option {{ ($color=='red') ? 'selected' : ''}} value="red">RED</option>
                            <option {{ ($color=='yellow') ? 'selected' : ''}} value="yellow">YELLOW</option>
                            <option {{ ($color=='green') ? 'selected' : ''}} value="green">GREEN</option>
                            <option {{ ($color=='blue') ? 'selected' : ''}} value="blue">BLUE</option>
                            <option {{ ($color=='indigo') ? 'selected' : ''}} value="indigo">INDIGO</option>
                            <option {{ ($color=='purple') ? 'selected' : ''}} value="purple">PURPLE</option>
                            <option {{ ($color=='pink') ? 'selected' : ''}} value="pink">PINK</option>
                        </x-forms.select-field>
                        <div class="w-full"></div>
                    </div>
                    @php
                    if($errors->has('title')) {
                        $title = old('title');
                    } else {
                        $title = (old('title')) ? old('title') : $announcement->title;
                    }
                    @endphp
                    <x-forms.input-field class="w-full"
                        name="title"
                        type="text"
                        label="Title"
                        placeholder="--"
                        value="{{ $title }}"
                        required
                    />
                    @php
                    if($errors->has('content')) {
                        $content = old('content');
                    } else {
                        $content = (old('content')) ? old('content') : $announcement->content;
                    }
                    @endphp
                    <x-forms.textarea-field
                        name="content"
                        label="Content of Announcement"
                        placeholder="Enter content"
                        rows="5"
                        value="{{ $content }}"
                        required
                    />
                    <hr class="my-1">
                    <div class="flex space-x-2 justify-end">
                        <span class="inline-block w-32">
                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                        </span>
                        <a href="/settings/announcements"
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
                        This will be the pricing per vehicle on CTPL insurance application.
                    </li>
                </ul>
            </section>
        </div>
    </div>
</x-layout>
