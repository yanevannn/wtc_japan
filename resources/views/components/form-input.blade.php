@props([
    'inputType' => null,
    'label' => null,
    'name',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'autocomplete' => 'off',
    'default' => 'Select Option',
    'options' => [],
])
@if ($inputType == null)
    <div>
        @if ($label)
            <label for="{{ $name }}" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                {{ $label }}
            </label>
        @endif

        <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}"
            placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" autocomplete="{{ $autocomplete }}"
            {{ $attributes->merge([
                'class' =>
                    'dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800',
            ]) }}>

        @error($name)
            <x-alert-validation message="{{ $message }}" />
        @enderror
    </div>
@elseif($inputType == 'file')
    <div>
        @if ($label)
            <label for="{{ $name }}" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                {{ $label }}
            </label>
        @endif
        <input id="{{ $name }}" name="{{ $name }}" type="file" value="{{ old($name, $value) }}"
            class="focus:border-ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 shadow-theme-xs transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pl-3.5 file:pr-3 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-none focus:file:ring-brand-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
        @error($name)
            <x-alert-validation message="{{ $message }}" />
        @enderror
    </div>
@elseif ($inputType == 'option')
    <div class="mt-2">
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
        </label>
        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
            <select name="{{ $name }}"
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                {{ $slot }}
            </select>
            <span
                class="pointer-events-none absolute right-4 top-1/2 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </span>
        </div>
        @error($name)
            <x-alert-validation message="{{ $message }}" />
        @enderror
    </div>
@elseif($inputType == 'date')
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
        </label>

        <div class="relative">
            <input type="date" placeholder="Select date" name="{{ $name }}"
                value="{{ old($name, $value) }}"
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                onclick="this.showPicker()">
            <span
                class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                        fill=""></path>
                </svg>
            </span>
        </div>
        @error($name)
            <x-alert-validation message="{{ $message }}" />
        @enderror
    </div>
@elseif($inputType == 'year')
    <div>
        @if ($label)
            <label for="{{ $name }}" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                {{ $label }}
            </label>
        @endif

        <input id="{{ $name }}" type="number" name="{{ $name }}" min="2024" max="2100"
            placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" autocomplete="{{ $autocomplete }}"
            {{ $attributes->merge([
                'class' =>
                    'dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800',
            ]) }}>

        @error($name)
            <x-alert-validation message="{{ $message }}" />
        @enderror
    </div>
@elseif($inputType == 'textarea')
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
        </label>
        <textarea placeholder="Enter a description..." type="text" rows="6"
            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
            name="{{ $name }}" value="{{ old($name, $value) }}">{{ $value }}</textarea>
    </div>
    @error($name)
        <x-alert-validation message="{{ $message }}" />
    @enderror
@endif
