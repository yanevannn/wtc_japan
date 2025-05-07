@props(['type' => 'default'])

@if ($type === 'default')
    <!-- Success Badge-->
    <span
        class="inline-flex items-center justify-center gap-1 rounded-full bg-success-50 px-2.5 py-0.5 text-sm font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
        {{ $slot }}
    </span>
@elseif ($type === 'error')
    <!-- Error Badge-->
    <span
        class="inline-flex items-center justify-center gap-1 rounded-full bg-error-50 px-2.5 py-0.5 text-sm font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
        {{ $slot }}
    </span>
@elseif ($type === 'warning')
    <!-- Warning Badge-->
    <span
        class="inline-flex items-center justify-center gap-1 rounded-full bg-warning-50 px-2.5 py-0.5 text-sm font-medium text-warning-600 dark:bg-warning-500/15 dark:text-orange-400">
        {{ $slot }}
    </span>
@elseif ($type === 'info')
    <!-- Info Badge-->
    <span
        class="inline-flex items-center justify-center gap-1 rounded-full bg-blue-light-50 px-2.5 py-0.5 text-sm font-medium text-blue-light-500 dark:bg-blue-light-500/15 dark:text-blue-light-500">
        {{ $slot }}
    </span>
@endif
