<li class="mb-10 ml-6 relative">
    @if($status === 'done')
        <span class="absolute -left-9 flex items-center justify-center w-6 h-6 bg-brand-500 rounded-full ring-8 ring-white dark:ring-gray-900">
            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </span>
    @elseif($status === 'current')
        <span class="absolute -left-9 flex items-center justify-center w-6 h-6 bg-white border-2 border-brand-500 dark:bg-gray-900 dark:border-brand-400 rounded-full">
            <span class="w-2.5 h-2.5 bg-brand-500 dark:bg-brand-400 rounded-full"></span>
        </span>
    @else
        <span class="absolute -left-9 flex items-center justify-center w-6 h-6 bg-white border-2 border-gray-300 dark:bg-gray-800 dark:border-gray-600 rounded-full"></span>
    @endif

    <h3 class="text-lg font-semibold
        {{ $status === 'done' ? 'text-black dark:text-white' : ($status === 'current' ? 'text-brand-600 dark:text-brand-400' : 'text-gray-400') }}">
        {{ $title }}
    </h3>

    <p class="text-sm
        {{ $status === 'done' ? 'text-gray-500 dark:text-gray-400' : ($status === 'current' ? 'text-gray-500 dark:text-gray-400' : 'text-gray-400 dark:text-gray-500') }}">
        {{ $description }}
    </p>
</li>
