@props([
    'action',
    'method' => 'POST',
])

<form action="{{ $action }}" method="POST" class="flex flex-col gap-4 mt-4">
    @csrf
    @if (strtoupper($method) !== 'POST')
        @method($method)
    @endif

    {{ $slot }}
</form>
