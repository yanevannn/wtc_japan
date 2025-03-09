@props(['type', 'url' => '#'])

@php
    $classes = [
        'add' => 'bg-green-500 hover:bg-green-600 text-white',
        'edit' => 'bg-blue-500 hover:bg-blue-600 text-white',
        'delete' => 'bg-red-500 hover:bg-red-600 text-white',
        'download' => 'bg-gray-500 hover:bg-gray-600 text-white',
        'save' => 'bg-yellow-500 hover:bg-yellow-600 text-white',
    ];

    $texts = [
        'add' => 'Tambah',
        'edit' => 'Edit',
        'delete' => 'Hapus',
        'download' => 'Download',
        'save' => 'Simpan',
    ];

    $icons = [
        'add' => file_get_contents(public_path('assets/icon-add.svg')),
        'edit' => file_get_contents(public_path('assets/icon-edit.svg')),
        'delete' => file_get_contents(public_path('assets/icon-delete.svg')),
        'download' => file_get_contents(public_path('assets/icon-download.svg')),
        'save' => file_get_contents(public_path('assets/icon-save.svg')),
    ];
@endphp

@if ($type === 'delete')
    <form action="{{ $url }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');"
        class="inline-flex">
        @csrf
        @method('DELETE')
        <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-lg font-semibold {{ $classes[$type] }}">
            {!! $icons[$type] !!} <span class="hidden md:inline">{{ $texts[$type] }}</span>
        </button>
    </form>
@elseif($type === 'save')
    <button type="submit"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold w-auto {{ $classes[$type] }}">
        {!! $icons[$type] !!} <span class="hidden md:inline">{{ $texts[$type] }}</span>
    </button>
@else
    <a href="{{ $url }}"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold w-auto {{ $classes[$type] }}">
        {!! $icons[$type] !!} <span class="hidden md:inline">{{ $texts[$type] }}</span>
    </a>
@endif

{{-- 
📌 Komponen Blade: <x-buttons>

📖 Deskripsi:
Komponen ini digunakan untuk menampilkan tombol aksi dengan ikon dan teks sesuai dengan jenis tombol yang dipilih.

📌 Cara Penggunaan:
<x-buttons type="add" />
<x-buttons type="edit" />
<x-buttons type="delete" />
<x-buttons type="download" />
<x-buttons type="save" />

📌 Atribut Tambahan:
- `url` (opsional) → Untuk tombol berbasis link (`add`, `edit`, `download`)
  Contoh: <x-buttons type="add" url="{{ route('items.create') }}" />
  
- `class` (opsional) → Untuk menambahkan kelas kustom pada tombol
  Contoh: <x-buttons type="save" class="bg-green-500 hover:bg-green-700 text-white" />

- `text` (opsional) → Untuk mengganti teks default tombol
  Contoh: <x-buttons type="save" text="Simpan Data" />

📌 Jenis Tombol & Atribut Default:
| **Type**   | **Aksi**         | **Ikon**                      | **Tipe**     |
|------------|----------------|--------------------------------|--------------|
| `add`      | Tambah Data     | `assets/icon-add.svg`         | `<a>` (link) |
| `edit`     | Edit Data       | `assets/icon-edit.svg`        | `<a>` (link) |
| `delete`   | Hapus Data      | `assets/icon-delete.svg`      | `<form>`     |
| `download` | Unduh File      | `assets/icon-download.svg`    | `<a>` (link) |
| `save`     | Simpan Data     | `assets/icon-save.svg`        | `<button>`   |

📌 Contoh Implementasi dalam Blade:
<x-buttons type="delete" url="{{ route('items.destroy', $id) }}" class="bg-red-500" />
<x-buttons type="save" text="Simpan Perubahan" />
<x-buttons type="add" url="{{ route('items.create') }}" />

📌 Catatan:
1. **Tombol `delete`** menggunakan metode `POST` dengan konfirmasi sebelum menghapus.
2. **Tombol `save`** adalah tombol submit dalam sebuah form.
3. **Tombol `add`, `edit`, dan `download`** menggunakan tag `<a>` untuk navigasi.
4. **Ikon diambil dari direktori `public/assets/`**, pastikan file SVG tersedia.

--}}
