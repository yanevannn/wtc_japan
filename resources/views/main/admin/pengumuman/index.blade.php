<x-main-layout>
    <x-slot:title>Pengumuman</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tabel Pengumuman WTC
                </h3>
                <x-button type="add" route="{{ route('pengumuman.create') }}" />
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <x-table>
                    <x-table-header :columns="['Judul', 'Deskripsi', 'Status', 'File']" :aligns="['left', 'left', 'left', 'left']" :widths="['w-60', '', 'w-20', 'w-20']" />
                    <x-table-body>
                        @if ($data->isEmpty())
                            <x-table-empty-row />
                        @else
                            @foreach ($data as $pengumuman)
                                <tr>
                                    <x-table-cell>{{ $loop->iteration }}</x-table-cell>
                                    <x-table-cell>{{ $pengumuman->judul }}</x-table-cell>
                                    <x-table-cell>{{ $pengumuman->deskripsi }}</x-table-cell>
                                    <x-table-cell>{{ $pengumuman->is_published ? 'Published' : 'Unpublish' }}</x-table-cell>
                                    <x-table-cell>{{ $pengumuman->file }}</x-table-cell>
                                    <x-table-cell>
                                        <div class="flex justify-center gap-2">
                                            <x-button type="edit"
                                                route="{{ route('pengumuman.edit', $pengumuman->id) }}" />
                                            <x-button type="delete"
                                                route="{{ route('pengumuman.destroy', $pengumuman->id) }}" />
                                        </div>
                                    </x-table-cell>
                                </tr>
                            @endforeach
                        @endif
                    </x-table-body>
                </x-table>

            </div>
        </div>
    </div>
    </div>
</x-main-layout>
