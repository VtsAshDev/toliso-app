@php
    $cores = [
        'error' => 'bg-red-100 text-red-700 border border-red-400',
        'success' => 'bg-green-100 text-green-700 border border-green-400',
    ];

    $classe = $cores[$type] ?? 'bg-gray-100 text-gray-700 border border-gray-400';
@endphp

<div class="p-4 rounded {{ $classe }}">
    {{ $message }}
</div>
