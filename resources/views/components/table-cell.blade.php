@props([
    'class' => '' // opsional, default left
])

<td class="px-5 py-4 sm:px-6">
    <div class="flex items-center {{ $class }}">
        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
            {{ $slot }}
        </p>
    </div>
</td>
