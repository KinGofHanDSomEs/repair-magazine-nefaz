@props([
    'name',
    'text',
    'type',
    'max_width' => '',
    'placeholder' => '',
    'value' => '',
    'withValue' => '1',
    'req' => 'required'
])

<div class="group-input flex flex-col mt-3">
    <label for="{{ $name }}" class="mb-1">{{ $text }}</label>

    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $withValue ? $value ? $value : old($name) : '' }}"
        class="{{ $max_width }} text-lg border border-c5 py-1 px-2 rounded-xl outline-none transition-colors placeholder:text-sm @error($name) border-red-600! @enderror"
        placeholder="{{ $placeholder }}"
        {{ $req }}
    >

    {{ $slot }}
</div>
