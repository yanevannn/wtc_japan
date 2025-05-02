@props([
    'align' => 'left', // opsional, default left
])

@php
    $classes = match ($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };
@endphp

<td class="px-5 py-4 sm:px-6 {{ $classes }}">
    <div class="flex items-center">
        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
            {{ $slot }}
        </p>
    </div>
</td>
