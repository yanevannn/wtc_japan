@props([
    'value',
    'selected' => null,
    'disabled' => false,
    'name' => '',
])

<option value="{{ $value }}" {{ (old($name, $selected) == $value) ? 'selected' : '' }} {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }}
</option>