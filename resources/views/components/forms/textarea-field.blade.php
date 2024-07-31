@props(['name','rows'=>3,'label','placeholder','required'=>false, 'value'=>''])

@php
    $errorClass = $errors->has($name) ? 'border-red-500' : '';
@endphp

<div {{ $attributes }}>
    <x-forms.label :for="$name">{{ $label }}</x-forms.label>
    <x-forms.textarea
        :$name
        :$placeholder
        :class="$errorClass"
        :$required
        :$rows
        :$value
    />
    @error($name)
        <x-forms.error>{{ $message }}</x-forms.error>
    @enderror
</div>
