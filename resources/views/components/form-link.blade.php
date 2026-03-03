@props([
    'href',
    'align' => ''
])

<a href="{{ $href }}" class="{{ $align }} text-xs c4 mt-2 transition-colors">{{ $slot }}</a>
