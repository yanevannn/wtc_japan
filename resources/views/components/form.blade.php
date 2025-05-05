@props(['action', 'method' => 'POST', 'hasFile' => false])

<form action="{{ $action }}" method="POST" class="flex flex-col gap-4 mt-4"
    @if ($hasFile) enctype="multipart/form-data" @endif>
    @csrf
    @if (strtoupper($method) !== 'POST')
        @method($method)
    @endif

    {{ $slot }}
</form>
