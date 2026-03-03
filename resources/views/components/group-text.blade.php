@props([
    'title',
    'bg' => 'bgt4',
    'mb' => '3'
])

<div class="group-text p-2 mb-{{ $mb }} rounded-2xl flex flex-col justify-center items-center {{ $bg }}">
    <p class="font-bold text-base">{{ $title }}</p>
    {{ $slot }}
</div>
