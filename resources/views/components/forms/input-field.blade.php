@props(['name','type','label','placeholder','required'=>false,'disabled'=>false,'value'=>'', 'maxlength'=>255])

@php
    $errorClass = $errors->has($name) ? 'border-red-500' : '';
@endphp

<div {{ $attributes }}>
    <x-forms.label :for="$name">{{ $label }}</x-forms.label>
    <x-forms.input
        :$name
        :$type
        :$placeholder
        :class="implode(' ', [$errorClass,($disabled ? 'bg-gray-500/25 cursor-not-allowed' : '')])"
        :$required
        :$disabled
        :$value
        :$maxlength
    />
    @error($name)
        <x-forms.error>{{ $message }}</x-forms.error>
    @enderror
</div>
