@props(['name','label','placeholder','required'=>false])

@php
    $errorClass = $errors->has($name) ? 'border-red-500' : '';
@endphp

<div {{ $attributes }}>
    <x-forms.label :for="$name">{{ $label }}</x-forms.label>
    <x-forms.select
        :$name
        :$placeholder
        :class="$errorClass"
        :$required>
        {{ $slot }}
    </x-forms.select>
    @error($name)
        <x-forms.error>{{ $message }}</x-forms.error>
    @enderror
</div>
