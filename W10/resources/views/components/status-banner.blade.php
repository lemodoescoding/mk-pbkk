@props(['type' => 'success'])

@php
    $colors = [
        'success' => 'bg-green-100 text-green-800 border-green-400',
        'error'   => 'bg-red-100 text-red-800 border-red-400',
        'info'    => 'bg-blue-100 text-blue-800 border-blue-400',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'border rounded-lg px-4 py-3 mb-4 ' . $colors[$type]]) }}>
    {{ $slot }}
</div>
