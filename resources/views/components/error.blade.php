@props(['field' => 'error'])

@error($field)
    <div class="text-red-600 mt-0.5 text-xs">{{ $message }}</div>
@enderror
