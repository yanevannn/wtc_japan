@props(['class' => ''])

<div {{ $attributes->merge(['class' => "bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 h-full $class"]) }}>
    {{ $slot }}
</div>
