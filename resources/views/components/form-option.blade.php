@props([
    'value',
    'selected' => null,
    'disabled' => false,
])

<option value="{{ $value }}" {{ ($selected == $value) ? 'selected' : '' }} {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }}
</option>