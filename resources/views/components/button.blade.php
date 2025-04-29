@props(['type' => '', 'route' => ''])

@if ($type === 'submit')
<div class="flex justify-end">
    <button type="submit"
        class="items-center gap-2 px-2 py-2 text-sm font-medium text-white transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600">Simpan
    </button>
</div>
@elseif($type === "save")
<div class="flex justify-end">
    <button type="submit"
        class="items-center gap-2 px-2 py-2 text-sm font-medium text-white transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600">Simpan Pembaruan
    </button>
</div>

@elseif ($type === 'add')
    <button
        class="items-center gap-2 px-2 py-2 text-sm font-medium text-white transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600">
        <a href="{{ $route }}">Tambah Data</a>
    </button>
@elseif($type === 'edit')
    <button
        class="items-center gap-2 px-2 py-2 text-sm font-medium text-white transition rounded-lg bg-warning-500 shadow-theme-xs hover:bg-warning-700">
        <a href="{{ $route }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-pencil-icon lucide-pencil">
                <path
                    d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                <path d="m15 5 4 4" />
            </svg>
        </a>
    </button>
@elseif($type === 'delete')
    <form id="form-delete" action="{{ $route }}" method="POST"
        class="items-center gap-2 px-2 py-2 text-sm font-medium text-white transition rounded-lg bg-red-500 shadow-theme-xs hover:bg-red-600 flex justify-center">
        @csrf
        @method('DELETE')
        <button type="button" onclick="confirmDelete(this)">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-trash2-icon lucide-trash-2">
                <path d="M3 6h18" />
                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                <line x1="10" x2="10" y1="11" y2="17" />
                <line x1="14" x2="14" y1="11" y2="17" />
            </svg>
        </button>
    </form>
@endif
