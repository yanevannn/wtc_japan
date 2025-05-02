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
@elseif ($inputType == 'option')
    <div class="mt-2">
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
        </label>
        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
            <select name="{{ $name }}"
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                :class="isOptionSelected && 'text-gray-800 dark:text-white/90'" @change="isOptionSelected = true">
                <option value="">{{ $default }}</option>
                @foreach ($options as $value => $text)
                    <option value="{{ $value }}" {{ old($name) == $value ? 'selected' : '' }}>{{ $text }}</option>
                @endforeach
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
@endif
