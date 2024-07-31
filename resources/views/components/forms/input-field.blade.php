@props(['name','type','label','placeholder','required'=>false,'value'=>''])

@php
    $errorClass = $errors->has($name) ? 'border-red-500' : '';
@endphp

<div {{ $attributes }}>
    <x-forms.label :for="$name">{{ $label }}</x-forms.label>
    <x-forms.input
        :$name
        :$type
        :$placeholder
        :class="$errorClass"
        :$required
        :$value
    />
    @error($name)
        <x-forms.error>{{ $message }}</x-forms.error>
    @enderror
</div>
